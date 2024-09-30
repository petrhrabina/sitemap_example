<?php

declare(strict_types=1);

namespace App\Sitemap\Domain;

use App\Sitemap\Domain\Variant\SitemapVariantType;
use App\Sitemap\Domain\Variant\SitemapVariantInterface;

interface SitemapVariantFactoryInterface
{
    public function create(SitemapVariantType $variantType): SitemapVariantInterface;
}