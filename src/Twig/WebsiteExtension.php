<?php

namespace App\Twig;

use App\Entity\Website;
use App\Storage\WebsiteImageStorage;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class WebsiteExtension extends AbstractExtension
{

	private WebsiteImageStorage $imageStorage;

	public function __construct(WebsiteImageStorage $imageStorage)
	{
		$this->imageStorage = $imageStorage;
	}

	public function getFilters(): array
	{
		return [
			new TwigFilter('getCategoriesFromWebsites', [$this, 'getCategoriesFromWebsites']),
			new TwigFilter('getImageUrl', [$this, 'getImageUrl']),
		];
	}

	public function getCategoriesFromWebsites(array $websites): array
	{
		$categories = [];

		foreach ($websites as $website) {
			$categories[$website->getCategory()->getName()] = $website->getCategory()->getName();
		}

		return $categories;
	}

	public function getImageUrl(Website $website)
	{
		return $this->imageStorage->getUrl($website);
	}
}
