<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210612172606 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client ADD departement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE client ADD commune_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE client DROP commune');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455CCF9E01E FOREIGN KEY (departement_id) REFERENCES departement (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455131A4F72 FOREIGN KEY (commune_id) REFERENCES commune (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_C7440455CCF9E01E ON client (departement_id)');
        $this->addSql('CREATE INDEX IDX_C7440455131A4F72 ON client (commune_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE client DROP CONSTRAINT FK_C7440455CCF9E01E');
        $this->addSql('ALTER TABLE client DROP CONSTRAINT FK_C7440455131A4F72');
        $this->addSql('DROP INDEX IDX_C7440455CCF9E01E');
        $this->addSql('DROP INDEX IDX_C7440455131A4F72');
        $this->addSql('ALTER TABLE client ADD commune VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE client DROP departement_id');
        $this->addSql('ALTER TABLE client DROP commune_id');
    }
}
