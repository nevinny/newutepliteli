<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250719172031 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE main DROP FOREIGN KEY FK_BF28CD64170B419C');
        $this->addSql('DROP INDEX IDX_BF28CD64170B419C ON main');
        $this->addSql('ALTER TABLE main DROP section_type_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE main ADD section_type_id INT NOT NULL');
        $this->addSql('ALTER TABLE main ADD CONSTRAINT FK_BF28CD64170B419C FOREIGN KEY (section_type_id) REFERENCES section_type (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_BF28CD64170B419C ON main (section_type_id)');
    }
}
