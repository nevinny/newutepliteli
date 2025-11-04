<?php

namespace App\Command;

use App\Service\MainRepairService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(name: 'app:main:repair', description: 'Repair missing Main records for products')]
class RepairMainCommand extends Command
{
    public function __construct(
        private MainRepairService $repairService,
    )
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Repairing missing Main records');

        try {
            $products = $this->repairService->findProductsWithoutMain();

            if (empty($products)) {
                $io->success('No missing Main records found');
                return Command::SUCCESS;
            }

            $io->warning(sprintf('Found %d products without Main records', count($products)));

            if (!$io->confirm('Do you want to repair these records?', true)) {
                return Command::SUCCESS;
            }

            $progressBar = new ProgressBar($output, count($products));
            $progressBar->start();

            // В реальной реализации нужно было бы сделать callback для прогресса
            // Но для простоты просто запускаем repair
            $repaired = $this->repairService->repairAllMissingMains();

            $progressBar->finish();
            $io->newLine(2);

            if ($repaired > 0) {
                $io->success(sprintf('Successfully repaired %d Main records', $repaired));
            } else {
                $io->warning('No records were repaired due to errors');
            }

            return Command::SUCCESS;

        } catch (\Exception $e) {
            $io->error('Command failed: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }
}
