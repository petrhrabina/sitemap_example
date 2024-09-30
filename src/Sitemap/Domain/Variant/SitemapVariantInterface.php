<?php

declare(strict_types=1);

namespace App\Sitemap\Domain\Variant;

use App\Sitemap\Domain\ValueObject\Url\SitemapUrlCollection;

interface SitemapVariantInterface
{
    public function getRouteCollection(): SitemapUrlCollection;
    
    public function getMaxUrlInOneFile(): int;
}
