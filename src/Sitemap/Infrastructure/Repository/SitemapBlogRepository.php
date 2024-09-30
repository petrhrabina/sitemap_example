<?php

declare(strict_types=1);

namespace App\Sitemap\Infrastructure\Repository;

use App\Blog\Infrastructure\Repository\BlogEntityRepository;
use App\Sitemap\Domain\SitemapVariantRepositoryInterface;

final class SitemapBlogRepository implements SitemapVariantRepositoryInterface
{
    public function __construct(private readonly BlogEntityRepository $blogEntityRepository)
    {
    }

    public function findAllVariantRecordsForSitemap(): array
    {
        return $this->blogEntityRepository->findAll();
    }

}