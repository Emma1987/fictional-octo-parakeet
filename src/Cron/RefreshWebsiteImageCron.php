<?php

namespace App\Cron;

use App\Entity\Website;
use App\Service\WebsiteImageUploader;
use Doctrine\ORM\EntityManagerInterface;
use Eckinox\CoreBundle\Cron\CronInterface;

class RefreshWebsiteImageCron implements CronInterface
{
	private EntityManagerInterface $entityManager;
	private WebsiteImageUploader $imageUploader;

	public function __construct(EntityManagerInterface $entityManager, WebsiteImageUploader $imageUploader)
	{
		$this->entityManager = $entityManager;
		$this->imageUploader = $imageUploader;
	}

	public function __invoke()
	{
		$websites = $this->entityManager->getRepository(Website::class)->findAll();

		/** @var Website $website */
		foreach ($websites as $website) {
			$this->imageUploader->updateImage($website);
		}

		$this->entityManager->flush();
	}

	public function getSchedule(): string
	{
		return '0 1 * * *';
	}
}
