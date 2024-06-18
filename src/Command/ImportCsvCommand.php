<?php

namespace App\Command;

use App\Service\CsvImportService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(
    name: 'app:import-csv',
    description: 'Import CSV data into the database.'
)]
class ImportCsvCommand extends Command
{
    private CsvImportService $csvImportService;

    public function __construct(CsvImportService $csvImportService)
    {
        parent::__construct();
        $this->csvImportService = $csvImportService;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('filename', InputArgument::REQUIRED, 'The name of the CSV file to import')
            ->setDescription('Imports data from a CSV file into the database.')
            ->setHelp('This command allows you to import data from a CSV file into the database. Example usage: php bin/console app:import-csv dummy_data.csv');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $filename = $input->getArgument('filename');
        $filePath = __DIR__ . '/../../public/uploads/' . $filename;

        if (!file_exists($filePath)) {
            $output->writeln('File not found: ' . $filePath);
            return Command::FAILURE;
        }

        $this->csvImportService->import($filePath);

        $output->writeln('CSV data imported successfully from ' . $filename);

        return Command::SUCCESS;
    }
}
