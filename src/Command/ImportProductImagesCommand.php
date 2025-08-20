<?php

namespace App\Command;

use App\Entity\Product;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\String\Slugger\AsciiSlugger;

#[AsCommand(
    name: 'app:import:product-images',
    description: 'Импорт картинок из старой базы в новую'
)]
class ImportProductImagesCommand extends Command
{
    private string $targetDir = '/Volumes/SAMSUNG/Users/zyablik/work/newutepliteli/public_html/images/product/';
    private string $sourceDir = '/Volumes/SAMSUNG/Users/zyablik/work/tdst-timeweb/utepliteli.org/public_html/upload/';

    public function __construct(
        private Connection             $connection, // Подключение к старой базе (настрой через doctrine.yaml)
        private EntityManagerInterface $em
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addOption('limit', null, InputOption::VALUE_REQUIRED, 'Сколько записей обрабатывать за раз', 100)
            ->addOption('id', null, InputOption::VALUE_OPTIONAL, 'Обработка конкретного product.id');
    }

    /**
     * @throws Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $limit = (int)$input->getOption('limit');
        $id = $input->getOption('id');

        $qb = $this->em->getRepository(Product::class)->createQueryBuilder('p')
            ->where('p.preview IS NULL OR p.image IS NULL');

        if ($id) {
            $qb->andWhere('p.id = :id')->setParameter('id', $id);
        }

        $products = $qb->setMaxResults($limit)->getQuery()->getResult();

        if (!$products) {
            $output->writeln('<info>Нет товаров для обработки</info>');
            return Command::SUCCESS;
        }

        $fs = new Filesystem();
        $slugger = new AsciiSlugger();

        foreach ($products as $product) {
            /** @var Product $product */
            $externalId = $product->getExternalId();

            // Получаем из старой базы preview/detail
            $row = $this->connection->fetchAssociative("
                SELECT e.PREVIEW_PICTURE, e.DETAIL_PICTURE
                FROM b_iblock_element e
                WHERE e.XML_ID like :xmlId
                AND e.PREVIEW_PICTURE IS NOT NULL
                LIMIT 1
            ", ['xmlId' => $externalId . '%']);

            if (!$row) {
                $output->writeln("<comment>Не найдено в старой базе: {$externalId}</comment>");
                continue;
            }

            foreach (['PREVIEW_PICTURE' => 'preview', 'DETAIL_PICTURE' => 'image'] as $field => $targetField) {
                if (!$row[$field]) {
                    continue;
                }

                $file = $this->connection->fetchAssociative("
                    SELECT SUBDIR, FILE_NAME
                    FROM b_file
                    WHERE ID = :id
                ", ['id' => $row[$field]]);

                if (!$file) {
                    continue;
                }

                $srcPath = $this->sourceDir . $file['SUBDIR'] . '/' . $file['FILE_NAME'];
                if (!file_exists($srcPath)) {
                    $output->writeln("<error>Файл не найден: {$srcPath}</error>");
                    continue;
                }

                $ext = pathinfo($file['FILE_NAME'], PATHINFO_EXTENSION);
                $newName = strtolower((string)$slugger->slug(pathinfo($file['FILE_NAME'], PATHINFO_FILENAME))) . '.' . $ext;
                $destPath = $this->targetDir . $newName;

                if (!$fs->exists($this->targetDir)) {
                    $fs->mkdir($this->targetDir, 0777);
                }

                $fs->copy($srcPath, $destPath, true);

                $product->{'set' . ucfirst($targetField)}('/images/product/' . $newName);
            }

            $this->em->persist($product);
            $output->writeln("<info>Обновлен товар #{$product->getId()}</info>");
        }

        $this->em->flush();

        return Command::SUCCESS;
    }
}
