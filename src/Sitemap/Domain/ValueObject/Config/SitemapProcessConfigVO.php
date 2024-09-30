<?php

declare(strict_types=1);

namespace App\Sitemap\Domain\ValueObject\Config;

final class SitemapProcessConfigVO
{
    public function __construct(
        private readonly string $baseFolderPath,
        private readonly string $processingFolderName,
        private readonly string $finalFolderName,
        private readonly string $backupFolderName,
    ) {
    }

    public function getBaseFolderPath(): string
    {
        return $this->baseFolderPath;
    }

    public function getProcessingFolderName(): string
    {
        return $this->processingFolderName;
    }

    public function getFinalFolderName(): string
    {
        return $this->finalFolderName;
    }

    public function getBackupFolderName(): string
    {
        return $this->backupFolderName;
    }
}
