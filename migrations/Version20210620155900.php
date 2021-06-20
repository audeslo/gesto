<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210620155900 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE detailtontine_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE detailtontine (id INT NOT NULL, operation_id INT NOT NULL, meconomie INT NOT NULL, mcredit INT DEFAULT NULL, dateope DATE NOT NULL, numclt VARCHAR(255) NOT NULL, numlivret SMALLINT NOT NULL, numordre SMALLINT NOT NULL, feuillet SMALLINT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D4EFB56744AC3583 ON detailtontine (operation_id)');
        $this->addSql('ALTER TABLE detailtontine ADD CONSTRAINT FK_D4EFB56744AC3583 FOREIGN KEY (operation_id) REFERENCES operation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE operation ADD note TEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE detailtontine_id_seq CASCADE');
        $this->addSql('DROP TABLE detailtontine');
        $this->addSql('ALTER TABLE operation DROP note');
    }
}
