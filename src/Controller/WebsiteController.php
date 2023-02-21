<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Website;
use App\Form\Type\ReviewType;
use App\Form\Type\WebsiteType;
use App\Repository\WebsiteRepository;
use App\Service\WebsiteImageUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class WebsiteController extends AbstractAppController
{
	private WebsiteRepository $websiteRepository;

	public function __construct(EntityManagerInterface $entityManager, TranslatorInterface $translator, WebsiteRepository $websiteRepository)
	{
		parent::__construct($entityManager, $translator);

		$this->websiteRepository = $websiteRepository;
	}

	/**
	 * @Route("/website/create", name="website_create")
	 */
	public function createWebsite(Request $request, WebsiteImageUploader $imageUploader): Response
	{
		$website = new Website();
		$form = $this->createForm(WebsiteType::class, $website);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$imageUploader->updateImage($website);

			$this->entityManager->persist($website);
			$this->entityManager->flush();

			$this->addFlash('success', $this->translator->trans('flashMessages.reviewSaved', [], 'messages'));

			return $this->redirectToRoute('website_view', ['id' => $website->getId()]);
		}

		return $this->render('website/create.html.twig', [
			'form' => $form->createView(),
		]);
	}

	/**
	 * @Route("/public/website/list", name="website_list")
	 */
	public function websiteList(): Response
	{
		$websites = $this->websiteRepository->findAllWithReviewAndCategory();

		return $this->render('website/list.html.twig', [
			'websites' => $websites,
			'filteredByCategory' => false,
		]);
	}

	/**
	 * @Route("/public/website/category/{id}", name="website_list_by_category")
	 */
	public function websiteListByCategory(Category $category): Response
	{
		$websites = $this->websiteRepository->findAllByCategoryWithWebsites($category);

		return $this->render('website/list.html.twig', [
			'websites' => $websites,
			'filteredByCategory' => true,
		]);
	}

	/**
	 * @Route("/public/website/{id}", name="website_view", methods={"GET"})
	 */
	public function view(Website $website): Response
	{
		$form = null;
		$review = null;

		if ($user = $this->getUser()) {
			$review = $website->getReviewByUser($user);
			$form = $this->createForm(ReviewType::class, $review, [
				'action' => $this->generateUrl('website_view_submit_review', ['id' => $website->getId()]),
			]);
		}

		return $this->render('website/view.html.twig', [
			'website' => $website,
			'form' => $form?->createView(),
			'reviewId' => $review?->getId(),
		]);
	}

	/**
	 * @Route("/website/{id}/submit-review", name="website_view_submit_review", methods={"POST"})
	 */
	public function submitReview(Request $request, Website $website): Response
	{
		$review = $website->getReviewByUser($this->getUser());
		$form = $this->createForm(ReviewType::class, $review);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$this->entityManager->persist($review);
			$this->entityManager->flush();

			$this->addFlash('success', $this->translator->trans('flashMessages.reviewSaved', [], 'messages'));

			return $this->redirectToRoute('website_view', ['id' => $website->getId()]);
		}

		$this->addFlash('error', $this->translator->trans('flashMessages.formError', [], 'messages'));

		return $this->redirectToRoute('website_view', ['id' => $website->getId()]);
	}
}
