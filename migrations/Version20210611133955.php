<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210611133955 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE client_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE zone_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE client (id INT NOT NULL, created_by_id INT DEFAULT NULL, edited_by_id INT DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, prenoms VARCHAR(255) NOT NULL, lieu VARCHAR(255) NOT NULL, profession VARCHAR(255) NOT NULL, activite VARCHAR(255) NOT NULL, quartier VARCHAR(255) NOT NULL, arrondissement VARCHAR(255) NOT NULL, commune VARCHAR(255) NOT NULL, datenais DATE NOT NULL, telephone VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, created_on TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, edited_on TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, type VARCHAR(20) DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, alt VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C7440455B03A8386 ON client (created_by_id)');
        $this->addSql('CREATE INDEX IDX_C7440455DD7B2EBC ON client (edited_by_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, created_by_id INT DEFAULT NULL, edited_by_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, sexe VARCHAR(1) DEFAULT NULL, slug VARCHAR(255) NOT NULL, telephone VARCHAR(255) DEFAULT NULL, username VARCHAR(255) NOT NULL, username_canonical VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, email_canonical VARCHAR(255) DEFAULT NULL, enabled BOOLEAN DEFAULT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, plain_password VARCHAR(255) DEFAULT NULL, last_login TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, confirmation_token VARCHAR(255) DEFAULT NULL, password_requested_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, groups TEXT DEFAULT NULL, roles TEXT DEFAULT NULL, created_on TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, edited_on TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, changedpassword BOOLEAN DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON "user" (username)');
        $this->addSql('CREATE INDEX IDX_8D93D649B03A8386 ON "user" (created_by_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649DD7B2EBC ON "user" (edited_by_id)');
        $this->addSql('COMMENT ON COLUMN "user".groups IS \'(DC2Type:array)\'');
        $this->addSql('COMMENT ON COLUMN "user".roles IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE zone (id INT NOT NULL, libelle VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455B03A8386 FOREIGN KEY (created_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455DD7B2EBC FOREIGN KEY (edited_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D649B03A8386 FOREIGN KEY (created_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D649DD7B2EBC FOREIGN KEY (edited_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE client DROP CONSTRAINT FK_C7440455B03A8386');
        $this->addSql('ALTER TABLE client DROP CONSTRAINT FK_C7440455DD7B2EBC');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D649B03A8386');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D649DD7B2EBC');
        $this->addSql('DROP SEQUENCE client_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE zone_id_seq CASCADE');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE zone');
    }
}
