<?php

declare(strict_types=1);

namespace App\Sitemap\Domain\Service;

use App\Sitemap\Domain\Variant\SitemapVariantType;
use App\Sitemap\Domain\ValueObject\Config\SitemapProcessConfigVO;
use App\Sitemap\Domain\ValueObject\Config\SitemapVariantConfigVO;
use App\Sitemap\Domain\SitemapOutputFileServiceInterface;
use App\Sitemap\Domain\SitemapVariantFactoryInterface;

final class SitemapProcessService
{
    public function __construct(
        private readonly SitemapVariantFactoryInterface $sitemapVariantFactory,
        private readonly SitemapOutputFileServiceInterface $outputFileService,
    ) {
    }

    public function processAllVariants(SitemapProcessConfigVO $processConfig): void
    {
        foreach (SitemapVariantType::cases() as $variantType) {
            $this->processOneVariant(
                $processConfig,
                $variantType
            );
        }

        $this->outputFileService->finalizeProcess($processConfig);
    }

    public function processOneVariant(
        SitemapProcessConfigVO $processConfig,
        SitemapVariantType $variantType
    ): void {
        $this->outputFileService->prepareProcess($processConfig);

        $sitemapVariant = $this->sitemapVariantFactory->create($variantType);

        $variantConfig = new SitemapVariantConfigVO(
            $variantType,
            $sitemapVariant->getMaxUrlInOneFile()
        );

        $this->outputFileService->saveUrlCollectionToGzipFileToProcessingFolder(
            $sitemapVariant->getRouteCollection(),
            $processConfig,
            $variantConfig
        );
    }
}
