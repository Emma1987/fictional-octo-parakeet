<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Website;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
	private EntityManagerInterface $entityManager;

	public function __construct(EntityManagerInterface $entityManager)
	{
		$this->entityManager = $entityManager;
	}

	/**
	 * @Route("/categories", name="category_list")
	 */
	public function categoryList(): Response
	{
		$categories = $this->entityManager->getRepository(Category::class)->findAll();

		return $this->render('category/list.html.twig', [
			'categories' => $categories,
		]);
	}
}
