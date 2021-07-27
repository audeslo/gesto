<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210710132829 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE agence_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE agent_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE client_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE commune_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE compte_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE departement_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE detailcaisse_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE detailtontine_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE exercice_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE operation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE parametre_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE periode_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE pret_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE tontine_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE zone_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE agence (id INT NOT NULL, created_by_id INT NOT NULL, edited_by_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, telephone VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) NOT NULL, adresse VARCHAR(255) DEFAULT NULL, created_on TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, edited_on TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, actif BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_64C19AA9B03A8386 ON agence (created_by_id)');
        $this->addSql('CREATE INDEX IDX_64C19AA9DD7B2EBC ON agence (edited_by_id)');
        $this->addSql('CREATE TABLE agent (id INT NOT NULL, edited_by_id INT DEFAULT NULL, created_by_id INT NOT NULL, nomag VARCHAR(255) DEFAULT NULL, prenomag VARCHAR(255) DEFAULT NULL, sexe VARCHAR(2) DEFAULT NULL, datenaiss DATE DEFAULT NULL, lieunaiss VARCHAR(60) DEFAULT NULL, telag VARCHAR(60) DEFAULT NULL, bpag VARCHAR(70) DEFAULT NULL, dateembaucheag DATE DEFAULT NULL, adressevilleag VARCHAR(255) DEFAULT NULL, adresserueag VARCHAR(255) DEFAULT NULL, situationmatri VARCHAR(60) DEFAULT NULL, nbreenft INT DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, alt VARCHAR(255) DEFAULT NULL, nomcompletag VARCHAR(255) DEFAULT NULL, actif BIGINT DEFAULT NULL, numerocompte VARCHAR(255) DEFAULT NULL, slug VARCHAR(255) DEFAULT NULL, edited_on DATE DEFAULT NULL, created_on TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, refag VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_268B9C9DDD7B2EBC ON agent (edited_by_id)');
        $this->addSql('CREATE INDEX IDX_268B9C9DB03A8386 ON agent (created_by_id)');
        $this->addSql('CREATE TABLE client (id INT NOT NULL, created_by_id INT NOT NULL, edited_by_id INT DEFAULT NULL, departement_id INT DEFAULT NULL, commune_id INT DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, prenoms VARCHAR(255) NOT NULL, lieu VARCHAR(255) NOT NULL, profession VARCHAR(255) NOT NULL, activite VARCHAR(255) NOT NULL, quartier VARCHAR(255) NOT NULL, arrondissement VARCHAR(255) NOT NULL, datenais DATE DEFAULT NULL, telephone VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, created_on TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, edited_on TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, type VARCHAR(20) DEFAULT NULL, url VARCHAR(255) DEFAULT NULL, alt VARCHAR(255) DEFAULT NULL, nomcomplet VARCHAR(255) DEFAULT NULL, numcli VARCHAR(20) NOT NULL, actif BOOLEAN DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C7440455B03A8386 ON client (created_by_id)');
        $this->addSql('CREATE INDEX IDX_C7440455DD7B2EBC ON client (edited_by_id)');
        $this->addSql('CREATE INDEX IDX_C7440455CCF9E01E ON client (departement_id)');
        $this->addSql('CREATE INDEX IDX_C7440455131A4F72 ON client (commune_id)');
        $this->addSql('CREATE TABLE commune (id INT NOT NULL, created_by_id INT DEFAULT NULL, edited_by_id INT DEFAULT NULL, departement_id INT NOT NULL, libelle VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, slug VARCHAR(255) NOT NULL, created_on TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, edited_on TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, actif BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E2E2D1EEB03A8386 ON commune (created_by_id)');
        $this->addSql('CREATE INDEX IDX_E2E2D1EEDD7B2EBC ON commune (edited_by_id)');
        $this->addSql('CREATE INDEX IDX_E2E2D1EECCF9E01E ON commune (departement_id)');
        $this->addSql('CREATE TABLE compte (id INT NOT NULL, agence_id INT DEFAULT NULL, client_id INT DEFAULT NULL, edited_by_id INT DEFAULT NULL, created_by_id INT NOT NULL, numcomp VARCHAR(50) NOT NULL, intitule VARCHAR(100) NOT NULL, cpcmd INT DEFAULT NULL, cpcmc INT DEFAULT NULL, solde INT DEFAULT NULL, cpdtder DATE DEFAULT NULL, datecompt DATE DEFAULT NULL, derniereop TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, annexo VARCHAR(255) DEFAULT NULL, edited_on TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_on TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, slug VARCHAR(255) NOT NULL, type VARCHAR(32) DEFAULT NULL, actif BOOLEAN DEFAULT NULL, devis VARCHAR(16) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_CFF65260D725330D ON compte (agence_id)');
        $this->addSql('CREATE INDEX IDX_CFF6526019EB6921 ON compte (client_id)');
        $this->addSql('CREATE INDEX IDX_CFF65260DD7B2EBC ON compte (edited_by_id)');
        $this->addSql('CREATE INDEX IDX_CFF65260B03A8386 ON compte (created_by_id)');
        $this->addSql('CREATE TABLE departement (id INT NOT NULL, created_by_id INT NOT NULL, edited_by_id INT DEFAULT NULL, libelle VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, slug VARCHAR(255) NOT NULL, created_on TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, edited_on TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, actif BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C1765B63B03A8386 ON departement (created_by_id)');
        $this->addSql('CREATE INDEX IDX_C1765B63DD7B2EBC ON departement (edited_by_id)');
        $this->addSql('CREATE TABLE detailcaisse (id INT NOT NULL, agent_id INT DEFAULT NULL, agence_id INT NOT NULL, created_by_id INT NOT NULL, dateope DATE DEFAULT NULL, libope VARCHAR(255) NOT NULL, entree INT DEFAULT NULL, sortie INT DEFAULT NULL, valide INT NOT NULL, typeope VARCHAR(255) DEFAULT NULL, created_on TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_456B740D3414710B ON detailcaisse (agent_id)');
        $this->addSql('CREATE INDEX IDX_456B740DD725330D ON detailcaisse (agence_id)');
        $this->addSql('CREATE INDEX IDX_456B740DB03A8386 ON detailcaisse (created_by_id)');
        $this->addSql('CREATE TABLE detailtontine (id INT NOT NULL, operation_id INT NOT NULL, tontine_id INT NOT NULL, client_id INT DEFAULT NULL, created_by_id INT NOT NULL, meconomie INT NOT NULL, mcredit INT DEFAULT NULL, dateope DATE NOT NULL, numclt VARCHAR(255) NOT NULL, ranglivret SMALLINT NOT NULL, numordre SMALLINT NOT NULL, feuillet SMALLINT NOT NULL, created_on TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D4EFB56744AC3583 ON detailtontine (operation_id)');
        $this->addSql('CREATE INDEX IDX_D4EFB567DEB5C9FD ON detailtontine (tontine_id)');
        $this->addSql('CREATE INDEX IDX_D4EFB56719EB6921 ON detailtontine (client_id)');
        $this->addSql('CREATE INDEX IDX_D4EFB567B03A8386 ON detailtontine (created_by_id)');
        $this->addSql('CREATE TABLE exercice (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE operation (id INT NOT NULL, agence_id INT DEFAULT NULL, created_by_id INT NOT NULL, edited_by_id INT DEFAULT NULL, client_id INT DEFAULT NULL, compte_id INT NOT NULL, numop INT DEFAULT NULL, numpiece INT DEFAULT NULL, dateop TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, libelleop VARCHAR(150) DEFAULT NULL, refpiece VARCHAR(100) DEFAULT NULL, montantop INT DEFAULT NULL, genere SMALLINT DEFAULT NULL, valide SMALLINT DEFAULT NULL, datecomptabilisation DATE DEFAULT NULL, created_on TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, edited_on DATE DEFAULT NULL, slug VARCHAR(255) DEFAULT NULL, note TEXT DEFAULT NULL, nomcomplet VARCHAR(255) DEFAULT NULL, operant VARCHAR(255) DEFAULT NULL, sens VARCHAR(16) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1981A66DD725330D ON operation (agence_id)');
        $this->addSql('CREATE INDEX IDX_1981A66DB03A8386 ON operation (created_by_id)');
        $this->addSql('CREATE INDEX IDX_1981A66DDD7B2EBC ON operation (edited_by_id)');
        $this->addSql('CREATE INDEX IDX_1981A66D19EB6921 ON operation (client_id)');
        $this->addSql('CREATE INDEX IDX_1981A66DF2C56620 ON operation (compte_id)');
        $this->addSql('CREATE TABLE parametre (id INT NOT NULL, denomination VARCHAR(64) NOT NULL, adresse VARCHAR(64) NOT NULL, telephone VARCHAR(32) NOT NULL, email VARCHAR(64) NOT NULL, ifu VARCHAR(32) NOT NULL, rccm VARCHAR(32) NOT NULL, ville VARCHAR(16) NOT NULL, devis VARCHAR(16) NOT NULL, logo BYTEA DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE periode (id INT NOT NULL, created_by_id INT NOT NULL, edited_by_id INT DEFAULT NULL, debut DATE NOT NULL, fin DATE NOT NULL, code VARCHAR(8) NOT NULL, annee SMALLINT NOT NULL, valeur SMALLINT NOT NULL, etat VARCHAR(16) DEFAULT NULL, created_on TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, edited_on DATE DEFAULT NULL, slug VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_93C32DF3B03A8386 ON periode (created_by_id)');
        $this->addSql('CREATE INDEX IDX_93C32DF3DD7B2EBC ON periode (edited_by_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_93C32DF3E81B0679AD2EF231 ON periode (debut, fin)');
        $this->addSql('CREATE TABLE pret (id INT NOT NULL, client_id INT DEFAULT NULL, agence_id INT DEFAULT NULL, agent_id INT DEFAULT NULL, created_by_id INT DEFAULT NULL, edited_by_id INT DEFAULT NULL, libellepret VARCHAR(255) DEFAULT NULL, datepret DATE DEFAULT NULL, slug VARCHAR(255) DEFAULT NULL, edited_on DATE DEFAULT NULL, created_on DATE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_52ECE97919EB6921 ON pret (client_id)');
        $this->addSql('CREATE INDEX IDX_52ECE979D725330D ON pret (agence_id)');
        $this->addSql('CREATE INDEX IDX_52ECE9793414710B ON pret (agent_id)');
        $this->addSql('CREATE INDEX IDX_52ECE979B03A8386 ON pret (created_by_id)');
        $this->addSql('CREATE INDEX IDX_52ECE979DD7B2EBC ON pret (edited_by_id)');
        $this->addSql('CREATE TABLE tontine (id INT NOT NULL, created_by_id INT NOT NULL, edited_by_id INT DEFAULT NULL, client_id INT NOT NULL, agence_id INT NOT NULL, compte_id INT NOT NULL, meconomie INT NOT NULL, numordre SMALLINT DEFAULT NULL, dateinscr DATE DEFAULT NULL, ranglivret INT NOT NULL, reflivret VARCHAR(255) NOT NULL, nbmois SMALLINT DEFAULT NULL, mcredit INT DEFAULT NULL, mdebit INT DEFAULT NULL, avance INT DEFAULT NULL, nbfeuillet INT NOT NULL, finfeuillet VARCHAR(255) DEFAULT NULL, nbmaxappoint INT DEFAULT NULL, dateraappoint DATE DEFAULT NULL, slug VARCHAR(255) NOT NULL, created_on DATE NOT NULL, edited_on DATE DEFAULT NULL, note TEXT DEFAULT NULL, actif BOOLEAN NOT NULL, bloqueravance BOOLEAN DEFAULT NULL, feuillet SMALLINT DEFAULT NULL, numcomp VARCHAR(32) NOT NULL, appointrest SMALLINT DEFAULT NULL, solde INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3F164B7FB03A8386 ON tontine (created_by_id)');
        $this->addSql('CREATE INDEX IDX_3F164B7FDD7B2EBC ON tontine (edited_by_id)');
        $this->addSql('CREATE INDEX IDX_3F164B7F19EB6921 ON tontine (client_id)');
        $this->addSql('CREATE INDEX IDX_3F164B7FD725330D ON tontine (agence_id)');
        $this->addSql('CREATE INDEX IDX_3F164B7FF2C56620 ON tontine (compte_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3F164B7F96E6776E6C89DB72 ON tontine (numcomp, ranglivret)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, created_by_id INT DEFAULT NULL, edited_by_id INT DEFAULT NULL, agence_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, sexe VARCHAR(1) DEFAULT NULL, slug VARCHAR(255) NOT NULL, telephone VARCHAR(255) DEFAULT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, email_canonical VARCHAR(255) DEFAULT NULL, enabled BOOLEAN DEFAULT NULL, salt VARCHAR(255) DEFAULT NULL, plain_password VARCHAR(255) DEFAULT NULL, last_login TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, created_on TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, edited_on TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, changedpassword BOOLEAN DEFAULT NULL, ipaddress VARCHAR(32) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON "user" (username)');
        $this->addSql('CREATE INDEX IDX_8D93D649B03A8386 ON "user" (created_by_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649DD7B2EBC ON "user" (edited_by_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649D725330D ON "user" (agence_id)');
        $this->addSql('CREATE TABLE zone (id INT NOT NULL, libelle VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE agence ADD CONSTRAINT FK_64C19AA9B03A8386 FOREIGN KEY (created_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE agence ADD CONSTRAINT FK_64C19AA9DD7B2EBC FOREIGN KEY (edited_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE agent ADD CONSTRAINT FK_268B9C9DDD7B2EBC FOREIGN KEY (edited_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE agent ADD CONSTRAINT FK_268B9C9DB03A8386 FOREIGN KEY (created_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455B03A8386 FOREIGN KEY (created_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455DD7B2EBC FOREIGN KEY (edited_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455CCF9E01E FOREIGN KEY (departement_id) REFERENCES departement (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455131A4F72 FOREIGN KEY (commune_id) REFERENCES commune (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE commune ADD CONSTRAINT FK_E2E2D1EEB03A8386 FOREIGN KEY (created_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE commune ADD CONSTRAINT FK_E2E2D1EEDD7B2EBC FOREIGN KEY (edited_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE commune ADD CONSTRAINT FK_E2E2D1EECCF9E01E FOREIGN KEY (departement_id) REFERENCES departement (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF65260D725330D FOREIGN KEY (agence_id) REFERENCES agence (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF6526019EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF65260DD7B2EBC FOREIGN KEY (edited_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF65260B03A8386 FOREIGN KEY (created_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE departement ADD CONSTRAINT FK_C1765B63B03A8386 FOREIGN KEY (created_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE departement ADD CONSTRAINT FK_C1765B63DD7B2EBC FOREIGN KEY (edited_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE detailcaisse ADD CONSTRAINT FK_456B740D3414710B FOREIGN KEY (agent_id) REFERENCES agent (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE detailcaisse ADD CONSTRAINT FK_456B740DD725330D FOREIGN KEY (agence_id) REFERENCES agence (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE detailcaisse ADD CONSTRAINT FK_456B740DB03A8386 FOREIGN KEY (created_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE detailtontine ADD CONSTRAINT FK_D4EFB56744AC3583 FOREIGN KEY (operation_id) REFERENCES operation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE detailtontine ADD CONSTRAINT FK_D4EFB567DEB5C9FD FOREIGN KEY (tontine_id) REFERENCES tontine (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE detailtontine ADD CONSTRAINT FK_D4EFB56719EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE detailtontine ADD CONSTRAINT FK_D4EFB567B03A8386 FOREIGN KEY (created_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE operation ADD CONSTRAINT FK_1981A66DD725330D FOREIGN KEY (agence_id) REFERENCES agence (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE operation ADD CONSTRAINT FK_1981A66DB03A8386 FOREIGN KEY (created_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE operation ADD CONSTRAINT FK_1981A66DDD7B2EBC FOREIGN KEY (edited_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE operation ADD CONSTRAINT FK_1981A66D19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE operation ADD CONSTRAINT FK_1981A66DF2C56620 FOREIGN KEY (compte_id) REFERENCES compte (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE periode ADD CONSTRAINT FK_93C32DF3B03A8386 FOREIGN KEY (created_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE periode ADD CONSTRAINT FK_93C32DF3DD7B2EBC FOREIGN KEY (edited_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pret ADD CONSTRAINT FK_52ECE97919EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pret ADD CONSTRAINT FK_52ECE979D725330D FOREIGN KEY (agence_id) REFERENCES agence (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pret ADD CONSTRAINT FK_52ECE9793414710B FOREIGN KEY (agent_id) REFERENCES agent (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pret ADD CONSTRAINT FK_52ECE979B03A8386 FOREIGN KEY (created_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE pret ADD CONSTRAINT FK_52ECE979DD7B2EBC FOREIGN KEY (edited_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tontine ADD CONSTRAINT FK_3F164B7FB03A8386 FOREIGN KEY (created_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tontine ADD CONSTRAINT FK_3F164B7FDD7B2EBC FOREIGN KEY (edited_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tontine ADD CONSTRAINT FK_3F164B7F19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tontine ADD CONSTRAINT FK_3F164B7FD725330D FOREIGN KEY (agence_id) REFERENCES agence (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tontine ADD CONSTRAINT FK_3F164B7FF2C56620 FOREIGN KEY (compte_id) REFERENCES compte (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D649B03A8386 FOREIGN KEY (created_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D649DD7B2EBC FOREIGN KEY (edited_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D649D725330D FOREIGN KEY (agence_id) REFERENCES agence (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE compte DROP CONSTRAINT FK_CFF65260D725330D');
        $this->addSql('ALTER TABLE detailcaisse DROP CONSTRAINT FK_456B740DD725330D');
        $this->addSql('ALTER TABLE operation DROP CONSTRAINT FK_1981A66DD725330D');
        $this->addSql('ALTER TABLE pret DROP CONSTRAINT FK_52ECE979D725330D');
        $this->addSql('ALTER TABLE tontine DROP CONSTRAINT FK_3F164B7FD725330D');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D649D725330D');
        $this->addSql('ALTER TABLE detailcaisse DROP CONSTRAINT FK_456B740D3414710B');
        $this->addSql('ALTER TABLE pret DROP CONSTRAINT FK_52ECE9793414710B');
        $this->addSql('ALTER TABLE compte DROP CONSTRAINT FK_CFF6526019EB6921');
        $this->addSql('ALTER TABLE detailtontine DROP CONSTRAINT FK_D4EFB56719EB6921');
        $this->addSql('ALTER TABLE operation DROP CONSTRAINT FK_1981A66D19EB6921');
        $this->addSql('ALTER TABLE pret DROP CONSTRAINT FK_52ECE97919EB6921');
        $this->addSql('ALTER TABLE tontine DROP CONSTRAINT FK_3F164B7F19EB6921');
        $this->addSql('ALTER TABLE client DROP CONSTRAINT FK_C7440455131A4F72');
        $this->addSql('ALTER TABLE operation DROP CONSTRAINT FK_1981A66DF2C56620');
        $this->addSql('ALTER TABLE tontine DROP CONSTRAINT FK_3F164B7FF2C56620');
        $this->addSql('ALTER TABLE client DROP CONSTRAINT FK_C7440455CCF9E01E');
        $this->addSql('ALTER TABLE commune DROP CONSTRAINT FK_E2E2D1EECCF9E01E');
        $this->addSql('ALTER TABLE detailtontine DROP CONSTRAINT FK_D4EFB56744AC3583');
        $this->addSql('ALTER TABLE detailtontine DROP CONSTRAINT FK_D4EFB567DEB5C9FD');
        $this->addSql('ALTER TABLE agence DROP CONSTRAINT FK_64C19AA9B03A8386');
        $this->addSql('ALTER TABLE agence DROP CONSTRAINT FK_64C19AA9DD7B2EBC');
        $this->addSql('ALTER TABLE agent DROP CONSTRAINT FK_268B9C9DDD7B2EBC');
        $this->addSql('ALTER TABLE agent DROP CONSTRAINT FK_268B9C9DB03A8386');
        $this->addSql('ALTER TABLE client DROP CONSTRAINT FK_C7440455B03A8386');
        $this->addSql('ALTER TABLE client DROP CONSTRAINT FK_C7440455DD7B2EBC');
        $this->addSql('ALTER TABLE commune DROP CONSTRAINT FK_E2E2D1EEB03A8386');
        $this->addSql('ALTER TABLE commune DROP CONSTRAINT FK_E2E2D1EEDD7B2EBC');
        $this->addSql('ALTER TABLE compte DROP CONSTRAINT FK_CFF65260DD7B2EBC');
        $this->addSql('ALTER TABLE compte DROP CONSTRAINT FK_CFF65260B03A8386');
        $this->addSql('ALTER TABLE departement DROP CONSTRAINT FK_C1765B63B03A8386');
        $this->addSql('ALTER TABLE departement DROP CONSTRAINT FK_C1765B63DD7B2EBC');
        $this->addSql('ALTER TABLE detailcaisse DROP CONSTRAINT FK_456B740DB03A8386');
        $this->addSql('ALTER TABLE detailtontine DROP CONSTRAINT FK_D4EFB567B03A8386');
        $this->addSql('ALTER TABLE operation DROP CONSTRAINT FK_1981A66DB03A8386');
        $this->addSql('ALTER TABLE operation DROP CONSTRAINT FK_1981A66DDD7B2EBC');
        $this->addSql('ALTER TABLE periode DROP CONSTRAINT FK_93C32DF3B03A8386');
        $this->addSql('ALTER TABLE periode DROP CONSTRAINT FK_93C32DF3DD7B2EBC');
        $this->addSql('ALTER TABLE pret DROP CONSTRAINT FK_52ECE979B03A8386');
        $this->addSql('ALTER TABLE pret DROP CONSTRAINT FK_52ECE979DD7B2EBC');
        $this->addSql('ALTER TABLE tontine DROP CONSTRAINT FK_3F164B7FB03A8386');
        $this->addSql('ALTER TABLE tontine DROP CONSTRAINT FK_3F164B7FDD7B2EBC');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D649B03A8386');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D649DD7B2EBC');
        $this->addSql('DROP SEQUENCE agence_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE agent_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE client_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE commune_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE compte_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE departement_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE detailcaisse_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE detailtontine_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE exercice_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE operation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE parametre_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE periode_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE pret_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE tontine_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE zone_id_seq CASCADE');
        $this->addSql('DROP TABLE agence');
        $this->addSql('DROP TABLE agent');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE commune');
        $this->addSql('DROP TABLE compte');
        $this->addSql('DROP TABLE departement');
        $this->addSql('DROP TABLE detailcaisse');
        $this->addSql('DROP TABLE detailtontine');
        $this->addSql('DROP TABLE exercice');
        $this->addSql('DROP TABLE operation');
        $this->addSql('DROP TABLE parametre');
        $this->addSql('DROP TABLE periode');
        $this->addSql('DROP TABLE pret');
        $this->addSql('DROP TABLE tontine');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE zone');
    }
}
