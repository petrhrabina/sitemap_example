<?php

declare(strict_types=1);

namespace App\Sitemap\Domain;

interface SitemapVariantRepositoryInterface
{
    public function findAllVariantRecordsForSitemap(): array;
}