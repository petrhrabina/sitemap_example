<?php

declare(strict_types=1);

namespace App\Sitemap\Domain\ValueObject\Url;

final class SitemapUrlVO
{
    public function __construct(private readonly string $url)
    {
    }

    public function get(): ?string
    {
        return $this->url;
    }
}
