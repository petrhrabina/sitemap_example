<?php

declare(strict_types=1);

namespace App\Sitemap\Infrastructure\Factory;

use App\Sitemap\Domain\Service\SitemapProcessService;
use App\Sitemap\Infrastructure\Service\SitemapOutputFileService;
use App\Sitemap\Infrastructure\Factory\SitemapVariantFactory;

final class SitemapProcessServiceFactory
{
    public function __construct(
        private readonly SitemapVariantFactory $sitemapVariantFactory,
        private readonly SitemapOutputFileService $outputFileService,
    ) {
    }

    public function create(): SitemapProcessService
    {
        return new SitemapProcessService(
            $this->sitemapVariantFactory,
            $this->outputFileService,
        );
    }
}
