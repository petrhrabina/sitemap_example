<?php

declare(strict_types=1);

namespace App\Sitemap\Domain\ValueObject\Config;

use App\Sitemap\Domain\Variant\SitemapVariantType;

final class SitemapVariantConfigVO
{
    public function __construct(
        private readonly SitemapVariantType $variantType,
        private readonly int $maxUrlInOneFile
    ) {
    }

    public function getVariantType(): SitemapVariantType
    {
        return $this->variantType;
    }

    public function getMaxUrlInOneFile(): int
    {
        return $this->maxUrlInOneFile;
    }
}
