<?php

declare(strict_types=1);

namespace App\Sitemap\Domain\Exception;

use Exception;

final class SitemapException extends Exception
{
    public function __construct(string $message, string $method)
    {
        parent::__construct(sprintf('[%s] %s', $method, $message));
    }
}
