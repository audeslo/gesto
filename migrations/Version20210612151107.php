<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210612151107 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE agence_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE commune_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE departement_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE agence (id INT NOT NULL, created_by_id INT DEFAULT NULL, edited_by_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, telephone VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, adresse VARCHAR(255) DEFAULT NULL, created_on TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, edited_on TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, actif BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_64C19AA9B03A8386 ON agence (created_by_id)');
        $this->addSql('CREATE INDEX IDX_64C19AA9DD7B2EBC ON agence (edited_by_id)');
        $this->addSql('CREATE TABLE commune (id INT NOT NULL, created_by_id INT DEFAULT NULL, edited_by_id INT DEFAULT NULL, departement_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, slug VARCHAR(255) NOT NULL, created_on TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, edited_on TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, actif BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E2E2D1EEB03A8386 ON commune (created_by_id)');
        $this->addSql('CREATE INDEX IDX_E2E2D1EEDD7B2EBC ON commune (edited_by_id)');
        $this->addSql('CREATE INDEX IDX_E2E2D1EECCF9E01E ON commune (departement_id)');
        $this->addSql('CREATE TABLE departement (id INT NOT NULL, created_by_id INT DEFAULT NULL, edited_by_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, slug VARCHAR(255) NOT NULL, created_on TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, edited_on TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, actif BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C1765B63B03A8386 ON departement (created_by_id)');
        $this->addSql('CREATE INDEX IDX_C1765B63DD7B2EBC ON departement (edited_by_id)');
        $this->addSql('ALTER TABLE agence ADD CONSTRAINT FK_64C19AA9B03A8386 FOREIGN KEY (created_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE agence ADD CONSTRAINT FK_64C19AA9DD7B2EBC FOREIGN KEY (edited_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE commune ADD CONSTRAINT FK_E2E2D1EEB03A8386 FOREIGN KEY (created_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE commune ADD CONSTRAINT FK_E2E2D1EEDD7B2EBC FOREIGN KEY (edited_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE commune ADD CONSTRAINT FK_E2E2D1EECCF9E01E FOREIGN KEY (departement_id) REFERENCES departement (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE departement ADD CONSTRAINT FK_C1765B63B03A8386 FOREIGN KEY (created_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE departement ADD CONSTRAINT FK_C1765B63DD7B2EBC FOREIGN KEY (edited_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE commune DROP CONSTRAINT FK_E2E2D1EECCF9E01E');
        $this->addSql('DROP SEQUENCE agence_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE commune_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE departement_id_seq CASCADE');
        $this->addSql('DROP TABLE agence');
        $this->addSql('DROP TABLE commune');
        $this->addSql('DROP TABLE departement');
    }
}
