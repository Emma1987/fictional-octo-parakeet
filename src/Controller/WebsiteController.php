<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Website;
use App\Form\Type\ReviewType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WebsiteController extends AbstractAppController
{
	/**
	 * @Route("/website/{id}", name="website_view")
	 */
	public function view(Request $request, Website $website): Response
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

		return $this->render('website/view.html.twig', [
			'website' => $website,
			'form' => $form->createView(),
			'reviewId' => $review->getId(),
		]);
	}

	/**
	 * @Route("/", name="website_list")
	 */
	public function websiteList(): Response
	{
		$websites = $this->entityManager->getRepository(Website::class)->findAllWithReviewAndCategory();

		return $this->render('website/list.html.twig', [
			'websites' => $websites,
		]);
	}

	/**
	 * @Route("/list-by-category", name="website_list_by_category")
	 */
	public function websiteListByCategory(): Response
	{
		$categories = $this->entityManager->getRepository(Category::class)->findAllWithWebsites();

		return $this->render('website/list_by_category.html.twig', [
			'categories' => $categories,
		]);
	}
}
