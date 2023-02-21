<?php

namespace App\Service;

use App\Entity\Website;
use App\Storage\WebsiteImageStorage;
use Cocur\Slugify\SlugifyInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class WebsiteImageUploader
{
	private HttpClientInterface $httpClient;
	private WebsiteImageStorage $imageStorage;
	private SlugifyInterface $slugify;

	public function __construct(HttpClientInterface $httpClient, WebsiteImageStorage $imageStorage, SlugifyInterface $slugify)
	{
		$this->httpClient = $httpClient;
		$this->imageStorage = $imageStorage;
		$this->slugify = $slugify;
	}

	public function updateImage(Website $website): void
	{
		$websiteUrl = $website->getUrl();

		try {
			if ($imageUrl = $this->getImageUrl($websiteUrl)) {
				$this->uploadImage($website, $imageUrl);
			}
		} catch (\Exception $e) {
			// Log error
		}
	}

	private function getImageUrl(string $websiteUrl): ?string
	{
		$response = $this->httpClient->request(Request::METHOD_GET, $websiteUrl);
		$htmlContent = $response->getContent();

		// Get og:image html
		if (!$start = stripos($htmlContent, '<meta property="og:image"')) {
			return null;
		}
		$end = stripos($htmlContent, '/>', $start);
		$ogImageHtml = substr($htmlContent, $start, $end - $start);

		// Get url within og:image html
		if (!$start = stripos($ogImageHtml, 'http')) {
			return null;
		}
		$end = stripos($ogImageHtml, '"', $start);
		return substr($ogImageHtml, $start, $end - $start);
	}

	private function uploadImage(Website $website, string $fileUrl): void
	{
		$ext = substr($fileUrl, strrpos($fileUrl, '.') + 1);
		$fileName = $this->slugify->slugify($website->getName(), '_') . '.' . $ext;
		$website->setImageName($fileName);

		$response = $this->httpClient->request(Request::METHOD_GET, $fileUrl);
		$file = $response->getContent();

		$this->imageStorage->upload($website, $file);
	}
}
