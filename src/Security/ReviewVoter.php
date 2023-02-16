<?php

namespace App\Security;

use App\Entity\Review;
use Eckinox\SecurityBundle\Entity\GenericUserInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class ReviewVoter extends Voter
{
	public const DELETE = 'delete';

	protected function supports(string $attribute, $subject): bool
	{
		if (!in_array($attribute, [self::DELETE])) {
			return false;
		}

		return $subject instanceof Review;
	}

	protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
	{
		$user = $token->getUser();

		if (!$user instanceof GenericUserInterface) {
			return false;
		}

		/** @var Review $review */
		$review = $subject;

		return match($attribute) {
			self::DELETE => $this->canDelete($review, $user),
			default => throw new \LogicException('This code should not be reached!')
		};
	}

	private function canDelete(Review $subject, GenericUserInterface $user): bool
	{
		return $subject->getUser() === $user;
	}
}
