<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250821150508 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product_price (id INT AUTO_INCREMENT NOT NULL, variant_id INT NOT NULL, type_id INT NOT NULL, price DOUBLE PRECISION NOT NULL, currency VARCHAR(10) NOT NULL, coefficient DOUBLE PRECISION DEFAULT NULL, INDEX IDX_6B9459853B69A9AF (variant_id), INDEX IDX_6B945985C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product_price ADD CONSTRAINT FK_6B9459853B69A9AF FOREIGN KEY (variant_id) REFERENCES product_variant (id)');
        $this->addSql('ALTER TABLE product_price ADD CONSTRAINT FK_6B945985C54C8C93 FOREIGN KEY (type_id) REFERENCES price_type (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_price DROP FOREIGN KEY FK_6B9459853B69A9AF');
        $this->addSql('ALTER TABLE product_price DROP FOREIGN KEY FK_6B945985C54C8C93');
        $this->addSql('DROP TABLE product_price');
    }
}
