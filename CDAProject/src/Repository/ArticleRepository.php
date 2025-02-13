<?php

namespace App\Repository;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Enum\StateEnum;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Article>
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function findByCategory(Category $category): array
    {
        return $this->createQueryBuilder('a')
            ->join('a.categories', 'c')
            ->where('c = :category')
            ->setParameter('category', $category)
            ->andWhere('a.state = :state')
            ->setParameter('state', StateEnum::PUBLISHED)
            ->orderBy('a.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }
}

