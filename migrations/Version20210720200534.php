<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210720200534 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE collecte_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE collecte (id INT NOT NULL, tontine_id INT NOT NULL, operaton_id INT NOT NULL, agence_id INT NOT NULL, created_by_id INT NOT NULL, edited_by_id INT DEFAULT NULL, libelleclt VARCHAR(255) NOT NULL, montantclt INT NOT NULL, dateclt TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, created_on TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, edited_on DATE DEFAULT NULL, slug VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_55AE4A3DDEB5C9FD ON collecte (tontine_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_55AE4A3D428A7084 ON collecte (operaton_id)');
        $this->addSql('CREATE INDEX IDX_55AE4A3DD725330D ON collecte (agence_id)');
        $this->addSql('CREATE INDEX IDX_55AE4A3DB03A8386 ON collecte (created_by_id)');
        $this->addSql('CREATE INDEX IDX_55AE4A3DDD7B2EBC ON collecte (edited_by_id)');
        $this->addSql('ALTER TABLE collecte ADD CONSTRAINT FK_55AE4A3DDEB5C9FD FOREIGN KEY (tontine_id) REFERENCES tontine (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE collecte ADD CONSTRAINT FK_55AE4A3D428A7084 FOREIGN KEY (operaton_id) REFERENCES operation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE collecte ADD CONSTRAINT FK_55AE4A3DD725330D FOREIGN KEY (agence_id) REFERENCES agence (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE collecte ADD CONSTRAINT FK_55AE4A3DB03A8386 FOREIGN KEY (created_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE collecte ADD CONSTRAINT FK_55AE4A3DDD7B2EBC FOREIGN KEY (edited_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE collecte_id_seq CASCADE');
        $this->addSql('DROP TABLE collecte');
    }
}
