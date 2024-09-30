<?php

declare(strict_types=1);

namespace App\Sitemap\Application\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use App\Sitemap\Domain\Variant\SitemapVariantType;
use App\Sitemap\Infrastructure\Factory\SitemapProcessServiceFactory;
use App\Sitemap\Domain\Service\SitemapProcessService;
use App\Sitemap\Domain\ValueObject\Config\SitemapProcessConfigVO;

#[AsCommand(
    name: 'sitemap',
    description: 'Generate the sitemap',
)]
class SitemapCommand extends Command
{
    public const OPTION_VARIANT = 'variant';

    private readonly SitemapProcessService $sitemapService;

    public function __construct(
        private SitemapProcessServiceFactory $sitemapServiceFactory,
        private ParameterBagInterface $params
    ) {
        parent::__construct();

        $this->sitemapService = $this->sitemapServiceFactory->create();
    }

    protected function configure(): void
    {
        $this->addOption(
            self::OPTION_VARIANT,
            null,
            InputOption::VALUE_REQUIRED,
            'One selected variant'
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $variant = $input->getOption(self::OPTION_VARIANT) ? SitemapVariantType::from($input->getOption(self::OPTION_VARIANT)) : null;

        $processConfig = new SitemapProcessConfigVO(
            $this->params->get('sitemap')['base_folder_path'],
            $this->params->get('sitemap')['processing_folder_name'],
            $this->params->get('sitemap')['final_folder_name'],
            $this->params->get('sitemap')['backup_folder_name']
        );

        if ($variant === null) {
            $this->sitemapService->processAllVariants($processConfig);
        } else {
            $this->sitemapService->processOneVariant($processConfig, $variant);
        }

        $output->writeln('Sitemap generation has been finished');

        return Command::SUCCESS;
    }
}
