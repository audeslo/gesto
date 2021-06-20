<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210617230100 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client ADD actif BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE tontine ADD nbfeuillet INT NOT NULL');
        $this->addSql('ALTER TABLE tontine ADD note TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE tontine ADD actif BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE tontine ADD bloqueravance BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE tontine DROP feuillet');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE client DROP actif');
        $this->addSql('ALTER TABLE tontine ADD feuillet INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tontine DROP nbfeuillet');
        $this->addSql('ALTER TABLE tontine DROP note');
        $this->addSql('ALTER TABLE tontine DROP actif');
        $this->addSql('ALTER TABLE tontine DROP bloqueravance');
    }
}
