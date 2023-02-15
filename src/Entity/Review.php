<?php

namespace App\Entity;

use App\Entity\Security\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReviewRepository")
 */
class Review
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(type="integer")
	 */
	private int $id;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private string $comment;

	/**
	 * @ORM\Column(type="integer")
	 */
	private int $rating;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Security\User")
	 */
	private User $user;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Website", inversedBy="reviews")
	 */
	private Website $website;

    public function getId(): ?int
    {
        return $this->id;
    }

	public function getComment(): ?string
	{
		return $this->comment;
	}

	public function setComment(string $comment): self
	{
		$this->comment = $comment;
		return $this;
	}

	public function getRating(): int
	{
		return $this->rating;
	}

	public function setRating(int $rating): self
	{
		$this->rating = $rating;
		return $this;
	}

	public function getUser(): ?User
	{
		return $this->user;
	}

	public function setUser(User $user): self
	{
		$this->user = $user;
		return $this;
	}

	public function getWebsite(): ?Website
	{
		return $this->website;
	}

	public function setWebsite(Website $website): self
	{
		$this->website = $website;
		return $this;
	}
}
