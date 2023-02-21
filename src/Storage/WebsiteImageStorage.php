<?php

namespace App\Storage;

use App\Entity\Website;
use Eckinox\AdminUiBundle\Storage\EntityStorageInterface;
use League\Flysystem\Config;
use League\Flysystem\Filesystem;
use League\Flysystem\Visibility;

class WebsiteImageStorage implements EntityStorageInterface
{
	public const DIRECTORY_NAME = 'websites-images';

	private Filesystem $filesystem;
	private string $cdnBaseUrl;

	public function __construct(Filesystem $filesystem, string $cdnBaseUrl)
	{
		$this->filesystem = $filesystem;
		$this->cdnBaseUrl = $cdnBaseUrl;
	}

	public function getSupportedEntity(): string
	{
		return Website::class;
	}

	public function getSupportedProperty(): string
	{
		return 'imageName';
	}

	public function getDirectory(object $entity): string
	{
		return self::DIRECTORY_NAME;
	}

	public function getUrl(object $entity, ?string $filename = null): ?string
	{
		if (!$this->filesystem->fileExists($this->getPath($entity))) {
			return null;
		}

		return rtrim($this->cdnBaseUrl, '/').'/'.ltrim($this->getPath($entity), '/');
	}

	public function upload(object $entity, string $contents, ?string $filename = null): void
	{
		$this->filesystem->write(
			$this->getPath($entity),
			$contents,
			[
				Config::OPTION_VISIBILITY => Visibility::PUBLIC,
			]
		);
	}

	public function get(object $entity, ?string $filename = null): string
	{
		return $this->filesystem->read($this->getPath($entity));
	}

	public function delete(object $entity, ?string $filename = null): void
	{
		$this->filesystem->delete($this->getPath($entity));
	}

	private function getPath(object $entity): string
	{
		return self::DIRECTORY_NAME . '/' . $entity->getImageName();
	}
}
