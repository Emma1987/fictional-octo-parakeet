<?php

namespace App\Security;

use App\Entity\Review;
use App\Entity\Security\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;

class ReviewVoter extends Voter
{
	public const DELETE = 'delete';

	private Security $security;

	public function __construct(Security $security)
	{
		$this->security = $security;
	}

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

		if (!$user instanceof User) {
			return false;
		}

		/** @var Review $review */
		$review = $subject;

		return match ($attribute) {
			self::DELETE => $this->canDelete($review, $user),
			default => throw new \LogicException('This code should not be reached!')
		};
	}

	private function canDelete(Review $subject, User $user): bool
	{
		if ($this->security->isGranted('REVIEW_DELETE')) {
			return true;
		}

		return $subject->getUser() === $user;
	}
}
