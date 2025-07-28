<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250723175524 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE section_link (id INT AUTO_INCREMENT NOT NULL, section_id INT NOT NULL, section_type_id INT NOT NULL, INDEX IDX_B31275FAD823E37A (section_id), INDEX IDX_B31275FA170B419C (section_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE section_link ADD CONSTRAINT FK_B31275FAD823E37A FOREIGN KEY (section_id) REFERENCES main (id)');
        $this->addSql('ALTER TABLE section_link ADD CONSTRAINT FK_B31275FA170B419C FOREIGN KEY (section_type_id) REFERENCES section_type (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE section_link DROP FOREIGN KEY FK_B31275FAD823E37A');
        $this->addSql('ALTER TABLE section_link DROP FOREIGN KEY FK_B31275FA170B419C');
        $this->addSql('DROP TABLE section_link');
    }
}
