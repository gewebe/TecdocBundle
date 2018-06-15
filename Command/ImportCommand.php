<?php

namespace Gweb\TecdocBundle\Command;

use Gweb\TecdocBundle\Service\ImportManager;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

/**
 * Command to run multi threaded tecdoc file import
 *
 * @author Gerd Weitenberg <gweitenb@gmail.com>
 */
class ImportCommand extends ContainerAwareCommand
{
    /**
     * @var ImportManager
     */
    private $importManager;

    protected function configure()
    {
        $this->setName('tecdoc:import')
          ->setDescription('Import tecdoc fixed width files to database')
          ->addOption('entity', null, InputOption::VALUE_REQUIRED, 'Import singe entity by full name')
          ->addOption('threads', null, InputOption::VALUE_REQUIRED, 'Import process max threads', 1);
    }

    /**
     * Run the import command
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->importManager = $this->getContainer()->get('gweb_tecdoc.import_manager');

        // import single entity
        $entity = $input->getOption('entity');
        if ($entity) {
            if (!class_exists($entity)) {
                throw new \RuntimeException('Entity not exists');
            }

            $result = $this->importManager->importEntity($entity, $output);
            foreach ($result as $fileName => $total) {
                if ($total === null) {
                    $output->writeln($fileName." File not exists");
                } else {
                    $output->writeln("$fileName Import Total: $total");
                }
            }
            return;
        };

        /**
         * collect all import processes by entities
         * @var Process[] $processQueue
         */
        $processQueue = [];
        foreach ($this->importManager->getEntities() as $entity) {
            $processQueue[] = new Process(
              'bin/console tecdoc:import --entity="'.$entity.'"', null, null, null, null
            );
        }

        /**
         * run import processes
         * @var Process[] $processCurrent
         */
        $processLimit = $input->getOption('threads');
        $processCurrent = [];
        while (count($processQueue) > 0 || count($processCurrent) > 0) {

            // remove finished processes
            foreach ($processCurrent as $index => $process) {
                if (!$process->isRunning()) {
                    $output->writeln('Finish Process: '.trim($process->getCommandLine()));
                    $output->writeln(trim($process->getOutput()));
                    unset($processCurrent[$index]);
                }
            }

            // start new processes
            if ($processLimit > count($processCurrent) && count($processQueue) > 0) {
                $process = array_shift($processQueue);
                $output->writeln('Start Process: '.$process->getCommandLine());
                $process->start();
                $processCurrent[] = $process;
            }

            usleep(1000);
        }
    }

}
