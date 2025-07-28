<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250720174549 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE IF NOT EXISTS store (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, ord INT DEFAULT 0 NOT NULL, meta_title VARCHAR(255) DEFAULT NULL, meta_description VARCHAR(255) DEFAULT NULL, meta_keywords VARCHAR(255) DEFAULT NULL, status VARCHAR(255) DEFAULT \'active\' NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
//        $this->addSql('ALTER TABLE main ADD CONSTRAINT FK_BF28CD645681BEB0 FOREIGN KEY (entity_type_id) REFERENCES section_type (id)');
//        $this->addSql('CREATE INDEX IDX_BF28CD645681BEB0 ON main (entity_type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE store');
        $this->addSql('ALTER TABLE main DROP FOREIGN KEY FK_BF28CD645681BEB0');
        $this->addSql('DROP INDEX IDX_BF28CD645681BEB0 ON main');
    }
}
