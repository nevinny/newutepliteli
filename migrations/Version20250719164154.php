<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250719164154 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE main (id INT AUTO_INCREMENT NOT NULL, section_type_id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, parent INT DEFAULT NULL, slug VARCHAR(255) NOT NULL, full_path VARCHAR(255) NOT NULL, template VARCHAR(255) DEFAULT NULL, ord INT DEFAULT NULL, is_node TINYINT(1) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, status VARCHAR(255) DEFAULT \'active\' NOT NULL, INDEX IDX_BF28CD64170B419C (section_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE main ADD CONSTRAINT FK_BF28CD64170B419C FOREIGN KEY (section_type_id) REFERENCES section_type (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE main DROP FOREIGN KEY FK_BF28CD64170B419C');
        $this->addSql('DROP TABLE main');
    }
}
