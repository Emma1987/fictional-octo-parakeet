<?php

namespace App\Controller;

use App\Entity\Security\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Contracts\Translation\TranslatorInterface;

abstract class AbstractAppController extends AbstractController
{
	protected EntityManagerInterface $entityManager;
	protected TranslatorInterface $translator;

	public function __construct(EntityManagerInterface $entityManager, TranslatorInterface $translator)
	{
		$this->entityManager = $entityManager;
		$this->translator = $translator;
	}

	protected function getUser(): ?User
	{
		if (!parent::getUser()) {
			return null;
		}

		$identifier = parent::getUser()->getUserIdentifier();
		return $this->entityManager->getRepository(User::class)->findOneBy(['email' => $identifier]);
	}
}
