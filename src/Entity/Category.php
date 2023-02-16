<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(type="integer")
	 */
    private ?int $id = null;

	/**
	 * @ORM\Column(type="string", length=80, unique=true)
	 */
	private ?string $name = null;

	/**
	 * @ORM\OneToMany(targetEntity="App\Entity\Website", mappedBy="category")
	 */
	private Collection $websites;

	public function __construct()
	{
		$this->websites = new ArrayCollection();
	}

    public function getId(): ?int
    {
        return $this->id;
    }

	public function getName(): ?string
	{
		return $this->name;
	}

	public function setName(string $name): self
	{
		$this->name = $name;
		return $this;
	}

	public function getWebsites(): Collection
	{
		return $this->websites;
	}

	public function addWebsite(Website $website): self
	{
		if (!$this->websites->contains($website)) {
			$this->websites->add($website);
		}

		return $this;
	}

	public function removeWebsite(Website $website): self
	{
		if ($this->websites->contains($website)) {
			$this->websites->remove($website);
		}

		return $this;
	}
}
