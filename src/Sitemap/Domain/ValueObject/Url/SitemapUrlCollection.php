<?php

declare(strict_types=1);

namespace App\Sitemap\Domain\ValueObject\Url;

/**
 * @template TUrlCollection of array<SitemapUrlVO>
 */
final class SitemapUrlCollection
{
    /** @var TUrlCollection */
    private array $urlCollection = [];

    public function add(SitemapUrlVO $urlVO): void
    {
        $this->urlCollection[] = $urlVO;
    }

    /** @return TUrlCollection */
    public function getAll(): array
    {
        return $this->urlCollection;
    }

}
