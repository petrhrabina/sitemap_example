<?php

declare(strict_types=1);

namespace App\Sitemap\Domain;

use App\Sitemap\Domain\ValueObject\Config\SitemapProcessConfigVO;
use App\Sitemap\Domain\ValueObject\Url\SitemapUrlCollection;
use App\Sitemap\Domain\ValueObject\Config\SitemapVariantConfigVO;

interface SitemapOutputFileServiceInterface
{
    public function prepareProcess(SitemapProcessConfigVO $processConfig): void;

    public function saveUrlCollectionToGzipFileToProcessingFolder(
        SitemapUrlCollection $urlCollection,
        SitemapProcessConfigVO $processConfig,
        SitemapVariantConfigVO $variantConfig
    ): void;

    public function finalizeProcess(SitemapProcessConfigVO $processConfig): void;
}
