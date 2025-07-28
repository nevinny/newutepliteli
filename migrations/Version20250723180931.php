<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250723180931 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE section_link DROP FOREIGN KEY FK_B31275FA170B419C');
        $this->addSql('ALTER TABLE section_link DROP FOREIGN KEY FK_B31275FAD823E37A');
        $this->addSql('DROP INDEX IDX_B31275FA170B419C ON section_link');
        $this->addSql('DROP INDEX IDX_B31275FAD823E37A ON section_link');
        $this->addSql('ALTER TABLE section_link ADD parent_type_id INT NOT NULL, ADD child_type_id INT NOT NULL, DROP section_id, DROP section_type_id');
        $this->addSql('ALTER TABLE section_link ADD CONSTRAINT FK_B31275FAB704F8D5 FOREIGN KEY (parent_type_id) REFERENCES section_type (id)');
        $this->addSql('ALTER TABLE section_link ADD CONSTRAINT FK_B31275FAA7F8C488 FOREIGN KEY (child_type_id) REFERENCES section_type (id)');
        $this->addSql('CREATE INDEX IDX_B31275FAB704F8D5 ON section_link (parent_type_id)');
        $this->addSql('CREATE INDEX IDX_B31275FAA7F8C488 ON section_link (child_type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE section_link DROP FOREIGN KEY FK_B31275FAB704F8D5');
        $this->addSql('ALTER TABLE section_link DROP FOREIGN KEY FK_B31275FAA7F8C488');
        $this->addSql('DROP INDEX IDX_B31275FAB704F8D5 ON section_link');
        $this->addSql('DROP INDEX IDX_B31275FAA7F8C488 ON section_link');
        $this->addSql('ALTER TABLE section_link ADD section_id INT NOT NULL, ADD section_type_id INT NOT NULL, DROP parent_type_id, DROP child_type_id');
        $this->addSql('ALTER TABLE section_link ADD CONSTRAINT FK_B31275FA170B419C FOREIGN KEY (section_type_id) REFERENCES section_type (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE section_link ADD CONSTRAINT FK_B31275FAD823E37A FOREIGN KEY (section_id) REFERENCES main (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_B31275FA170B419C ON section_link (section_type_id)');
        $this->addSql('CREATE INDEX IDX_B31275FAD823E37A ON section_link (section_id)');
    }
}
