<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250719175421 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE main CHANGE parent parent_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE main ADD CONSTRAINT FK_BF28CD64727ACA70 FOREIGN KEY (parent_id) REFERENCES main (id)');
        $this->addSql('CREATE INDEX IDX_BF28CD64727ACA70 ON main (parent_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE main DROP FOREIGN KEY FK_BF28CD64727ACA70');
        $this->addSql('DROP INDEX IDX_BF28CD64727ACA70 ON main');
        $this->addSql('ALTER TABLE main CHANGE parent_id parent INT DEFAULT NULL');
    }
}
