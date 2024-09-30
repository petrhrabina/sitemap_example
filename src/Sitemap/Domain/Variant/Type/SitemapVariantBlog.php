<?php

declare(strict_types=1);

namespace App\Sitemap\Domain\Variant\Type;

use App\Sitemap\Domain\Variant\AbstractSitemapVariant;
use App\Sitemap\Domain\ValueObject\Url\SitemapUrlCollection;
use App\Sitemap\Domain\ValueObject\Url\SitemapUrlVO;

class SitemapVariantBlog extends AbstractSitemapVariant
{
    public function getRouteCollection(): SitemapUrlCollection
    {
        $routeCollection = new SitemapUrlCollection();

        foreach ($this->variantRepository->findAllVariantRecordsForSitemap() as $article) {
            $routeCollection->add(
                new SitemapUrlVO(
                    $this->urlGenerator->generateUrl(
                        'blog_show',
                        sprintf(
                            '%s-abc-%s',
                            $article->getLabel(),
                            $article->getSlug()
                        )
                    )
                )
            );
        }

        return $routeCollection;
    }
}
