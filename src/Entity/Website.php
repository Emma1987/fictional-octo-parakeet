<?php

namespace App\Entity;

use App\Entity\Security\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WebsiteRepository")
 */
class Website
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(type="integer")
	 */
    private ?int $id = null;

	/**
	 * @ORM\Column(type="string", length=255)
	 * @Assert\NotBlank()
	 * @Assert\Length(
	 *     min = 2,
	 *     max = 255,
	 * )
	 */
	private ?string $name = null;

	/**
	 * @ORM\Column(type="string", length=255, unique=true)
	 * @Assert\NotBlank()
	 * @Assert\Url()
	 */
	private ?string $url = null;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private ?string $imageName = null;

	/**
	 * @ORM\OneToMany(targetEntity="App\Entity\Review", mappedBy="website")
	 */
	private Collection $reviews;

	/**
	 * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="websites")
	 */
	private ?Category $category = null;

	public function __construct()
	{
		$this->reviews = new ArrayCollection();
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

	public function getUrl(): ?string
	{
		return $this->url;
	}

	public function setUrl(string $url): self
	{
		$this->url = $url;
		return $this;
	}

	public function getImageName(): ?string
	{
		return $this->imageName;
	}

	public function setImageName(?string $imageName): self
	{
		$this->imageName = $imageName;
		return $this;
	}

	public function getReviews(): Collection
	{
		return $this->reviews;
	}

	public function addReview(Review $review): self
	{
		if (!$this->reviews->contains($review)) {
			$this->reviews->add($review);
			$review->setWebsite($this);
		}

		return $this;
	}

	public function getCategory(): ?Category
	{
		return $this->category;
	}

	public function setCategory(Category $category): self
	{
		$this->category = $category;
		return $this;
	}

	public function getAverageRating(): ?float
	{
		if ($this->reviews->isEmpty()) {
			return null;
		}

		$ratings = array_reduce($this->reviews->toArray(), function ($carry, Review $review) {
			$carry += $review->getRating();
			return $carry;
		});

		return round(($ratings / $this->reviews->count()), 1);
	}

	public function getReviewByUser(User $user): Review
	{
		foreach ($this->reviews as $review) {
			if ($review->getUser() === $user) {
				return $review;
			}
		}

		return (new Review())
			->setWebsite($this)
			->setUser($user);
	}
}
