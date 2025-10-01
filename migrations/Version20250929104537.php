<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250929104537 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contacts
    ADD store_addr VARCHAR(255) DEFAULT NULL,
    ADD store_phone VARCHAR(255) DEFAULT NULL,
    ADD store_email VARCHAR(255) DEFAULT NULL,
    ADD store_work_hours VARCHAR(255) DEFAULT NULL,
    ADD store_coordinates VARCHAR(255) DEFAULT NULL
    ');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contacts DROP store_addr, DROP store_phone, DROP store_email, DROP store_work_hours, DROP store_coordinates');
    }
}
