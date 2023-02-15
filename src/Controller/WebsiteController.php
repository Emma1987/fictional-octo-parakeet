<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Website;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WebsiteController extends AbstractController
{
	private EntityManagerInterface $entityManager;

	public function __construct(EntityManagerInterface $entityManager)
	{
		$this->entityManager = $entityManager;
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
