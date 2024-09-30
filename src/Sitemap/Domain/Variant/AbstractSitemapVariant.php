<?php

declare(strict_types=1);

namespace App\Sitemap\Domain\Variant;

use App\Sitemap\Domain\SitemapVariantRepositoryInterface;
use App\Sitemap\Domain\SitemapUrlGeneratorInterface;


abstract class AbstractSitemapVariant implements SitemapVariantInterface
{
    public function __construct(
        protected readonly SitemapVariantRepositoryInterface $variantRepository,
        protected readonly SitemapUrlGeneratorInterface $urlGenerator
    ) {
    }

    public function getMaxUrlInOneFile(): int
    {
        return 2000;
    }
}
