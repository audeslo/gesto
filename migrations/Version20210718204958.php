<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210718204958 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE avancement_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE avancement (id INT NOT NULL, operation_id INT NOT NULL, agence_id INT NOT NULL, created_by_id INT NOT NULL, edited_by_id INT DEFAULT NULL, client_id INT DEFAULT NULL, tontine_id INT NOT NULL, libelleavan VARCHAR(255) NOT NULL, montantavan INT NOT NULL, dateavan DATE NOT NULL, soldecomp INT NOT NULL, created_on TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, edited_on DATE DEFAULT NULL, slug VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6D2A7A2A44AC3583 ON avancement (operation_id)');
        $this->addSql('CREATE INDEX IDX_6D2A7A2AD725330D ON avancement (agence_id)');
        $this->addSql('CREATE INDEX IDX_6D2A7A2AB03A8386 ON avancement (created_by_id)');
        $this->addSql('CREATE INDEX IDX_6D2A7A2ADD7B2EBC ON avancement (edited_by_id)');
        $this->addSql('CREATE INDEX IDX_6D2A7A2A19EB6921 ON avancement (client_id)');
        $this->addSql('CREATE INDEX IDX_6D2A7A2ADEB5C9FD ON avancement (tontine_id)');
        $this->addSql('ALTER TABLE avancement ADD CONSTRAINT FK_6D2A7A2A44AC3583 FOREIGN KEY (operation_id) REFERENCES operation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE avancement ADD CONSTRAINT FK_6D2A7A2AD725330D FOREIGN KEY (agence_id) REFERENCES agence (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE avancement ADD CONSTRAINT FK_6D2A7A2AB03A8386 FOREIGN KEY (created_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE avancement ADD CONSTRAINT FK_6D2A7A2ADD7B2EBC FOREIGN KEY (edited_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE avancement ADD CONSTRAINT FK_6D2A7A2A19EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE avancement ADD CONSTRAINT FK_6D2A7A2ADEB5C9FD FOREIGN KEY (tontine_id) REFERENCES tontine (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE avancement_id_seq CASCADE');
        $this->addSql('DROP TABLE avancement');
    }
}
