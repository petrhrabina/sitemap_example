<?php

declare(strict_types=1);

namespace App\Sitemap\Domain\Variant\Type;

use App\Sitemap\Domain\Variant\AbstractSitemapVariant;
use App\Sitemap\Domain\ValueObject\Url\SitemapUrlCollection;
use App\Sitemap\Domain\ValueObject\Url\SitemapUrlVO;

class SitemapVariantBrand extends AbstractSitemapVariant
{
    public function getMaxUrlInOneFile(): int
    {
        return 1000;
    }

    public function getRouteCollection(): SitemapUrlCollection
    {
        $routeCollection = new SitemapUrlCollection();

        foreach ($this->variantRepository->findAllVariantRecordsForSitemap() as $brand) {
            $routeCollection->add(
                new SitemapUrlVO(
                    $this->urlGenerator->generateUrl(
                        'brand_show',
                        sprintf(
                            '%s-%s',
                            $brand->getName(),
                            $brand->getSlug()
                        )
                    )
                )
            );
        }

        return $routeCollection;
    }
}
