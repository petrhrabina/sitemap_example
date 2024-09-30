<?php

declare(strict_types=1);

namespace App\Sitemap\Domain\Variant;

enum SitemapVariantType: string
{
    case Blog = 'blog';
    case Brand = 'brand';
}
