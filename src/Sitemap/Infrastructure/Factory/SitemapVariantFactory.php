<?php

declare(strict_types=1);

namespace App\Sitemap\Infrastructure\Factory;

use App\Sitemap\Domain\Variant\SitemapVariantType;
use App\Sitemap\Domain\Variant\SitemapVariantInterface;
use App\Sitemap\Domain\Exception\SitemapException;
use App\Sitemap\Domain\Variant\Type\SitemapVariantBlog;
use App\Sitemap\Domain\Variant\Type\SitemapVariantBrand;
use App\Sitemap\Domain\SitemapVariantFactoryInterface;
use App\Sitemap\Infrastructure\Repository\SitemapBlogRepository;
use App\Sitemap\Infrastructure\Repository\SitemapBrandRepository;
use App\Sitemap\Infrastructure\Service\SitemapUrlGeneratorService;

final class SitemapVariantFactory implements SitemapVariantFactoryInterface
{
    public function __construct(
        private readonly SitemapBlogRepository $blogRepository,
        private readonly SitemapBrandRepository $brandRepository,
        private readonly SitemapUrlGeneratorService $urlGenerator
    ) {
    }

    public function create(SitemapVariantType $variantType): SitemapVariantInterface
    {
        switch ($variantType) {
            case SitemapVariantType::Blog:
                return new SitemapVariantBlog(
                    $this->blogRepository,
                    $this->urlGenerator
                );
            case SitemapVariantType::Brand:
                return new SitemapVariantBrand(
                    $this->brandRepository,
                    $this->urlGenerator
                );
            default:
                throw new SitemapException(
                    sprintf('Variant "%s" is not supported.', $variantType->name),
                    __METHOD__
                );
        }
    }
}