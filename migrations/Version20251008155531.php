<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251008155531 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
//        $this->addSql('DROP TABLE from_tnshop');
//        $this->addSql('CREATE UNIQUE INDEX product_unique_idx ON product (brand_id, title)');
        $this->addSql('ALTER TABLE product_variant ADD availability VARCHAR(20) DEFAULT \'preorder\' NOT NULL, ADD origin_url VARCHAR(255) DEFAULT NULL, ADD origin_image VARCHAR(255) DEFAULT NULL');
//        $this->addSql('CREATE UNIQUE INDEX product_unique_idx ON product_variant (product_id, external_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE from_tnshop (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, sku VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, added INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP INDEX product_unique_idx ON product');
        $this->addSql('DROP INDEX product_unique_idx ON product_variant');
        $this->addSql('ALTER TABLE product_variant DROP availability, DROP origin_url, DROP origin_image');
    }
}
