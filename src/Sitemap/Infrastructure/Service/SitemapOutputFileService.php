<?php

declare(strict_types=1);

namespace App\Sitemap\Infrastructure\Service;

use XMLWriter;
use Symfony\Component\Filesystem\Path;
use Symfony\Component\Filesystem\Filesystem;
use App\Sitemap\Domain\ValueObject\Url\SitemapUrlCollection;
use App\Sitemap\Domain\ValueObject\Config\SitemapProcessConfigVO;
use App\Sitemap\Domain\ValueObject\Config\SitemapVariantConfigVO;
use App\Sitemap\Domain\ValueObject\Url\SitemapUrlVO;
use App\Sitemap\Domain\SitemapOutputFileServiceInterface;

final class SitemapOutputFileService implements SitemapOutputFileServiceInterface
{
    public function __construct(private readonly Filesystem $filesystem)
    {
    }

    public function saveUrlCollectionToGzipFileToProcessingFolder(
        SitemapUrlCollection $urlCollection,
        SitemapProcessConfigVO $processConfig,
        SitemapVariantConfigVO $variantConfig
    ): void {
        $xmlWriter = new XMLWriter();
        $xmlWriter->openMemory();
        $xmlWriter->setIndent(true);
        $xmlWriter->startDocument('1.0', 'utf-8');
        $xmlWriter->startElement('sitemapindex');
        $xmlWriter->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        $xmlWriter->writeAttribute('xmlns:image', 'http://www.google.com/schemas/sitemap-image/1.1');

        $fileChunkNumber = 1;
        foreach (array_chunk($urlCollection->getAll(), max($variantConfig->getMaxUrlInOneFile(), 1)) as $chunk) {

            /** @var SitemapUrlVO $url */
            foreach ($chunk as $url) {
                $xmlWriter->startElement('url');
                $xmlWriter->writeElement('loc', $url->get());
                $xmlWriter->endElement();
            }

            $fullPath = Path::join(
                $this->getFullPathToFolder($processConfig, $processConfig->getProcessingFolderName()),
                sprintf('%s.%s.xml.gz', $variantConfig->getVariantType()->value, $fileChunkNumber)
            );

            $compressedContent = gzencode($xmlWriter->outputMemory());
            $this->filesystem->dumpFile($fullPath, $compressedContent);

            $fileChunkNumber++;
        }

        $xmlWriter->flush();
    }

    public function prepareProcess(SitemapProcessConfigVO $processConfig): void
    {
        $processingFolderPath = $this->getFullPathToFolder(
            $processConfig,
            $processConfig->getProcessingFolderName()
        );

        if (!is_dir($processingFolderPath)) {
            $this->filesystem->mkdir($processingFolderPath);
        }
    }

    public function finalizeProcess(SitemapProcessConfigVO $processConfig): void
    {
        $processingFolderPath = Path::join(
            $processConfig->getBaseFolderPath(),
            $processConfig->getProcessingFolderName()
        );
        $finalFolderPath = Path::join(
            $processConfig->getBaseFolderPath(),
            $processConfig->getFinalFolderName()
        );
        $backupFolderPath = Path::join(
            $processConfig->getBaseFolderPath(),
            $processConfig->getBackupFolderName()
        );

        if (is_dir($backupFolderPath)) {
            $this->filesystem->remove($backupFolderPath);
        }

        if (is_dir($finalFolderPath)) {
            $this->filesystem->rename($finalFolderPath, $backupFolderPath);
        }

        $this->filesystem->rename($processingFolderPath, $finalFolderPath);
    }

    private function getFullPathToFolder(SitemapProcessConfigVO $processConfig, string $folderName): string
    {
        return Path::join(
            $processConfig->getBaseFolderPath(),
            $folderName
        );
    }
}
