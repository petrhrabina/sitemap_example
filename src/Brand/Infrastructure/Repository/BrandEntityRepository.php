<?php

namespace App\Brand\Infrastructure\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Brand\Domain\Entity\BrandEntity;
use App\Brand\Domain\BrandEntityRepositoryInterface;

/**
 * @extends ServiceEntityRepository<BrandEntity>
 */
class BrandEntityRepository extends ServiceEntityRepository implements BrandEntityRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BrandEntity::class);
    }
}
