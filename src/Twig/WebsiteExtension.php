<?php

namespace App\Twig;

use App\Entity\Website;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class WebsiteExtension extends AbstractExtension
{
	public function getFilters()
	{
		return [
			new TwigFilter('getCategoriesFromWebsites', [$this, 'getCategoriesFromWebsites']),
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
}
