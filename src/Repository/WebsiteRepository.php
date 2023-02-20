<?php

namespace App\Repository;

use App\Entity\Category;
use App\Entity\Website;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Website>
 *
 * @method Website|null find($id, $lockMode = null, $lockVersion = null)
 * @method Website|null findOneBy(array $criteria, array $orderBy = null)
 * @method Website[]    findAll()
 * @method Website[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WebsiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Website::class);
    }

	/**
	 * @return Website[]
	 */
	public function findAllWithReviewAndCategory(): array
	{
		return $this->createQueryBuilder('w')
			->leftJoin('w.reviews', 'r')
			->leftJoin('w.category', 'c')
			->select('w, r, c')
			->getQuery()
			->getResult();
	}

	/**
	 * @return Website[]
	 */
	public function findAllByCategoryWithWebsites(Category $category): array
	{
		return $this->createQueryBuilder('w')
			->leftJoin('w.reviews', 'r')
			->leftJoin('w.category', 'c')
			->select('w, r, c')
			->andWhere('w.category = :category')
			->setParameters([
				'category' => $category,
			])
			->getQuery()
			->getResult();
	}
}
