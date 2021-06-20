<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210617220855 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE compte ALTER created_on SET NOT NULL');
        $this->addSql('ALTER TABLE tontine ADD reflivret VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE tontine ADD mdebit INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tontine DROP numton');
        $this->addSql('ALTER TABLE tontine DROP remboursement');
        $this->addSql('ALTER TABLE tontine DROP interet');
        $this->addSql('ALTER TABLE tontine DROP feuillet');
        $this->addSql('ALTER TABLE tontine DROP numcreditencours');
        $this->addSql('ALTER TABLE tontine ALTER numlivret TYPE INT');
        $this->addSql('ALTER TABLE tontine ALTER numlivret DROP DEFAULT');
        $this->addSql('ALTER TABLE tontine ALTER created_on SET NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE compte ALTER created_on DROP NOT NULL');
        $this->addSql('ALTER TABLE tontine ADD remboursement INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tontine ADD interet INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tontine ADD feuillet VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE tontine ADD numcreditencours VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE tontine DROP reflivret');
        $this->addSql('ALTER TABLE tontine ALTER numlivret TYPE SMALLINT');
        $this->addSql('ALTER TABLE tontine ALTER numlivret DROP DEFAULT');
        $this->addSql('ALTER TABLE tontine ALTER created_on DROP NOT NULL');
        $this->addSql('ALTER TABLE tontine RENAME COLUMN mdebit TO numton');
    }
}
