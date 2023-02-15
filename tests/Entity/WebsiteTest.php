<?php

namespace Entity;

use App\Entity\Review;
use App\Entity\Website;
use PHPUnit\Framework\TestCase;

class WebsiteTest extends TestCase
{
	public function testGetAverageRating()
	{
		$firstReview = (new Review())
			->setRating(5);

		$secondReview = (new Review())
			->setRating(8);

		$thirdReview = (new Review())
			->setRating(3);

		$website = (new Website())
			->addReview($firstReview)
			->addReview($secondReview)
			->addReview($thirdReview);

		$this->assertEquals(5.3, $website->getAverageRating());

		$fourthReview = (new Review())
			->setRating(7);

		$website->addReview($fourthReview);

		$this->assertEquals(5.8, $website->getAverageRating());
	}

	public function testGetAverageRatingReturnsNullIfNoReview()
	{
		$website = (new Website());

		$this->assertNull($website->getAverageRating());
	}
}
