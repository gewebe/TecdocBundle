<?php

namespace Gweb\TecdocBundle\Command;

use Gweb\TecdocBundle\Service\FileExtract;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

/**
 * Command to extract tecdoc 7z compressed files
 *
 * Example usage to extract all files:
 * php bin/console tecdoc:extract --reference=0118 --supplier --media
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
class ExtractCommand extends Command
{
    /**
     * @var ParameterBagInterface
     */
    private $params;

    public function __construct(ParameterBagInterface $params)
    {
        parent::__construct();

        $this->params = $params;
    }

    protected function configure()
    {
        $this->setName('tecdoc:extract')
            ->setDescription('Extract tecdoc 7z compressed files')
            ->addOption('reference', null, InputOption::VALUE_REQUIRED, 'Extract reference file, i.e: version 0118', false)
            ->addOption('supplier', null, InputOption::VALUE_OPTIONAL, 'Extract data supplier files', false)
            ->addOption('media', null, InputOption::VALUE_OPTIONAL, 'Extract data supplier media files', false);
    }

    /**
     * Run the extract command
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        if ($input->getOption('reference') !== false) {
            FileExtract::reference(
                $this->params->get('gweb_tecdoc.dir_download_reference'),
                $this->params->get('gweb_tecdoc.dir_data_reference'),
                $input->getOption('reference')
            );
        }

        if ($input->getOption('supplier') !== false) {
            FileExtract::suppliers(
                $this->params->get('gweb_tecdoc.dir_download_supplier'),
                $this->params->get('gweb_tecdoc.dir_data_supplier')
            );
        }

        if ($input->getOption('media') !== false) {
            FileExtract::media(
                $this->params->get('gweb_tecdoc.dir_download_media'),
                $this->params->get('gweb_tecdoc.dir_data_media')
            );
        }
    }
}
