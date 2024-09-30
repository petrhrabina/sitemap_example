<?php

declare(strict_types=1);

namespace App\Sitemap\Domain;

interface SitemapUrlGeneratorInterface
{
    public function generateUrl(string $name, string $slug): string;
}
