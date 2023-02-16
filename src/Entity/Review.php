<?php

namespace App\Entity;

use App\Entity\Security\User;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
	private ?int $id = null;

	/**
	 * @ORM\Column(type="text", length=1000, nullable=true)
	 * @Assert\Length(
	 *     max = 1000,
	 * )
	 */
	private ?string $comment = null;

	/**
	 * @ORM\Column(type="integer")
	 * @Assert\Range(
	 *     min = 1,
	 *     max = 5,
	 * )
	 */
	private ?int $rating = null;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Security\User")
	 */
	private ?User $user = null;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Website", inversedBy="reviews")
	 */
	private ?Website $website = null;

    public function getId(): ?int
    {
        return $this->id;
    }

	public function getComment(): ?string
	{
		return $this->comment;
	}

	public function setComment(?string $comment): self
	{
		$this->comment = $comment;
		return $this;
	}

	public function getRating(): ?int
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
