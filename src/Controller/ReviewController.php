<?php

namespace App\Controller;

use App\Entity\Review;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class ReviewController extends AbstractAppController
{
	/**
	 * @Route("/review/{id}/delete", name="review_delete")
	 */
	public function delete(Review $review): Response
	{
		$website = $review->getWebsite();

		try {
			$this->denyAccessUnlessGranted('delete', $review);

			$this->entityManager->remove($review);
			$this->entityManager->flush();

			$this->addFlash('success', $this->translator->trans('flashMessages.reviewDeleted', [], 'messages'));
		} catch (AccessDeniedException $e) {
			$this->addFlash('error', $this->translator->trans('flashMessages.accessDenied', [], 'messages'));
		}

		return $this->redirectToRoute('website_view', ['id' => $website->getId()]);
	}
}
