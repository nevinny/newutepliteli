<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250803185822 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_params DROP FOREIGN KEY FK_EDB24F574584665A');
        $this->addSql('DROP INDEX IDX_EDB24F574584665A ON product_params');
        $this->addSql('DROP INDEX product_params_unique_idx ON product_params');
        $this->addSql('ALTER TABLE product_params CHANGE product_id variant_id INT NOT NULL');
        $this->addSql('ALTER TABLE product_params ADD CONSTRAINT FK_EDB24F573B69A9AF FOREIGN KEY (variant_id) REFERENCES product_variant (id)');
        $this->addSql('CREATE INDEX IDX_EDB24F573B69A9AF ON product_params (variant_id)');
        $this->addSql('CREATE UNIQUE INDEX product_variants_unique_idx ON product_params (variant_id, external_id)');
        $this->addSql('CREATE UNIQUE INDEX product_unique_idx ON product_variant (product_id, external_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product_params DROP FOREIGN KEY FK_EDB24F573B69A9AF');
        $this->addSql('DROP INDEX IDX_EDB24F573B69A9AF ON product_params');
        $this->addSql('DROP INDEX product_variants_unique_idx ON product_params');
        $this->addSql('ALTER TABLE product_params CHANGE variant_id product_id INT NOT NULL');
        $this->addSql('ALTER TABLE product_params ADD CONSTRAINT FK_EDB24F574584665A FOREIGN KEY (product_id) REFERENCES product (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_EDB24F574584665A ON product_params (product_id)');
        $this->addSql('CREATE UNIQUE INDEX product_params_unique_idx ON product_params (product_id, external_id)');
        $this->addSql('DROP INDEX product_unique_idx ON product_variant');
    }
}
