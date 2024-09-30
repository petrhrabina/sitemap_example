<?php

declare(strict_types=1);

namespace App\Sitemap\Infrastructure\Repository;

use App\Sitemap\Domain\SitemapVariantRepositoryInterface;
use App\Brand\Infrastructure\Repository\BrandEntityRepository;

final class SitemapBrandRepository implements SitemapVariantRepositoryInterface
{
    public function __construct(private readonly BrandEntityRepository $brandEntityRepository)
    {
    }

    public function findAllVariantRecordsForSitemap(): array
    {
        return $this->brandEntityRepository->findAll();
    }
}