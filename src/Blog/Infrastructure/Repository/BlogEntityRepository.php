<?php

namespace App\Blog\Infrastructure\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Blog\Domain\Entity\BlogEntity;
use App\Blog\Domain\BlogEntityRepositoryInterface;

/**
 * @extends ServiceEntityRepository<BlogEntity>
 */
class BlogEntityRepository extends ServiceEntityRepository implements BlogEntityRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BlogEntity::class);
    }
}
