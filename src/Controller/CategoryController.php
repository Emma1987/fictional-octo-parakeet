<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractAppController
{
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
