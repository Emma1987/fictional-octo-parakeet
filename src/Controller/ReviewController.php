<?php

namespace App\Controller;

use App\Entity\Review;
use App\Form\Type\ReviewType;
use App\Security\ReviewVoter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class ReviewController extends AbstractAppController
{
	/**
	 * @Route("/review/{id}/edit", name="review_edit")
	 * @IsGranted("REVIEW_EDIT")
	 */
	public function edit(Request $request, Review $review): Response
	{
		$form = $this->createForm(ReviewType::class, $review, []);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			$this->entityManager->flush();

			$this->addFlash('success', $this->translator->trans('flashMessages.reviewSaved', [], 'messages'));
			return $this->redirectToRoute('website_view', ['id' => $review->getWebsite()->getId()]);
		}

		return $this->render('review/edit.html.twig', [
			'review' => $review,
			'form' => $form->createView(),
		]);
	}

	/**
	 * @Route("/review/{id}/delete", name="review_delete")
	 */
	public function delete(Review $review): Response
	{
		$website = $review->getWebsite();

		try {
			$this->denyAccessUnlessGranted(ReviewVoter::DELETE, $review);

			$this->entityManager->remove($review);
			$this->entityManager->flush();

			$this->addFlash('success', $this->translator->trans('flashMessages.reviewDeleted', [], 'messages'));
		} catch (AccessDeniedException $e) {
			$this->addFlash('error', $this->translator->trans('flashMessages.accessDenied', [], 'messages'));
		}

		return $this->redirectToRoute('website_view', ['id' => $website->getId()]);
	}
}
