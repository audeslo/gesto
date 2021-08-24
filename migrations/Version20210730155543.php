<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210730155543 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE collecte_id_seq CASCADE');
        $this->addSql('DROP TABLE collecte');
        $this->addSql('ALTER TABLE operation ADD solde INT NOT NULL');
        $this->addSql('ALTER TABLE tontine ALTER mtcollecte SET NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE collecte_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE collecte (id INT NOT NULL, tontine_id INT NOT NULL, operation_id INT NOT NULL, agence_id INT NOT NULL, created_by_id INT NOT NULL, edited_by_id INT DEFAULT NULL, libelleclt VARCHAR(255) NOT NULL, montantclt INT NOT NULL, dateclt TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, created_on TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, edited_on DATE DEFAULT NULL, slug VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_55ae4a3ddd7b2ebc ON collecte (edited_by_id)');
        $this->addSql('CREATE INDEX idx_55ae4a3db03a8386 ON collecte (created_by_id)');
        $this->addSql('CREATE UNIQUE INDEX uniq_55ae4a3d44ac3583 ON collecte (operation_id)');
        $this->addSql('CREATE UNIQUE INDEX uniq_55ae4a3ddeb5c9fd ON collecte (tontine_id)');
        $this->addSql('CREATE INDEX idx_55ae4a3dd725330d ON collecte (agence_id)');
        $this->addSql('ALTER TABLE collecte ADD CONSTRAINT fk_55ae4a3ddeb5c9fd FOREIGN KEY (tontine_id) REFERENCES tontine (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE collecte ADD CONSTRAINT fk_55ae4a3dd725330d FOREIGN KEY (agence_id) REFERENCES agence (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE collecte ADD CONSTRAINT fk_55ae4a3db03a8386 FOREIGN KEY (created_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE collecte ADD CONSTRAINT fk_55ae4a3ddd7b2ebc FOREIGN KEY (edited_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE collecte ADD CONSTRAINT fk_55ae4a3d44ac3583 FOREIGN KEY (operation_id) REFERENCES operation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE operation DROP solde');
        $this->addSql('ALTER TABLE tontine ALTER mtcollecte DROP NOT NULL');
    }
}
