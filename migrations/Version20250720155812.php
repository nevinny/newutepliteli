<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250720155812 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
//        $this->addSql('ALTER TABLE main ADD entity_type_id INT NOT NULL');
        $this->addSql('ALTER TABLE main ADD CONSTRAINT FK_BF28CD645681BEB0 FOREIGN KEY (entity_type_id) REFERENCES section_type (id)');
        $this->addSql('CREATE INDEX IDX_BF28CD645681BEB0 ON main (entity_type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE main DROP FOREIGN KEY FK_BF28CD645681BEB0');
        $this->addSql('DROP INDEX IDX_BF28CD645681BEB0 ON main');
        $this->addSql('ALTER TABLE main ADD entity_type VARCHAR(255) NOT NULL, DROP entity_type_id');
    }
}
