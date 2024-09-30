<?php

declare(strict_types=1);

namespace App\Sitemap\Infrastructure\Service;

use App\Sitemap\Domain\SitemapUrlGeneratorInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class SitemapUrlGeneratorService implements SitemapUrlGeneratorInterface
{
    public function __construct(private UrlGeneratorInterface $urlGenerator)
    {
    }
    public function generateUrl(string $name, string $slug): string
    {
        return $this->urlGenerator->generate($name, [
            'slug' => $slug,
        ]);
    }
}
