<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210613132925 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE compte (id INT AUTO_INCREMENT NOT NULL, agence_id INT DEFAULT NULL, client_id INT DEFAULT NULL, edited_by_id INT DEFAULT NULL, created_by_id INT DEFAULT NULL, numcomp VARCHAR(50) NOT NULL, intitule VARCHAR(100) NOT NULL, cpcmd INT DEFAULT NULL, cpcmc INT DEFAULT NULL, cpasld INT NOT NULL, cpasldj INT DEFAULT NULL, cpnbmvt INT DEFAULT NULL, cpdtder DATE DEFAULT NULL, mdate DATE DEFAULT NULL, mheure DATETIME DEFAULT NULL, annexo VARCHAR(255) DEFAULT NULL, edited_on DATETIME DEFAULT NULL, created_on DATETIME DEFAULT NULL, slug VARCHAR(255) NOT NULL, INDEX IDX_CFF65260D725330D (agence_id), INDEX IDX_CFF6526019EB6921 (client_id), INDEX IDX_CFF65260DD7B2EBC (edited_by_id), INDEX IDX_CFF65260B03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF65260D725330D FOREIGN KEY (agence_id) REFERENCES agence (id)');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF6526019EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF65260DD7B2EBC FOREIGN KEY (edited_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF65260B03A8386 FOREIGN KEY (created_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE tontine ADD created_by_id INT DEFAULT NULL, ADD edited_by_id INT DEFAULT NULL, ADD client_id INT DEFAULT NULL, ADD agence_id INT DEFAULT NULL, ADD compte_id INT DEFAULT NULL, ADD numton INT DEFAULT NULL, ADD mcredit INT DEFAULT NULL, ADD remboursement INT DEFAULT NULL, ADD avance INT DEFAULT NULL, ADD interet INT DEFAULT NULL, ADD feuillet VARCHAR(255) DEFAULT NULL, ADD finfeuillet VARCHAR(255) DEFAULT NULL, ADD numcreditencours VARCHAR(255) DEFAULT NULL, ADD nbmaxappoint INT DEFAULT NULL, ADD dateraappoint DATE DEFAULT NULL, ADD slug VARCHAR(255) DEFAULT NULL, ADD created_on DATE DEFAULT NULL, ADD edited_on DATE DEFAULT NULL, DROP numclient');
        $this->addSql('ALTER TABLE tontine ADD CONSTRAINT FK_3F164B7FB03A8386 FOREIGN KEY (created_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE tontine ADD CONSTRAINT FK_3F164B7FDD7B2EBC FOREIGN KEY (edited_by_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE tontine ADD CONSTRAINT FK_3F164B7F19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE tontine ADD CONSTRAINT FK_3F164B7FD725330D FOREIGN KEY (agence_id) REFERENCES agence (id)');
        $this->addSql('ALTER TABLE tontine ADD CONSTRAINT FK_3F164B7FF2C56620 FOREIGN KEY (compte_id) REFERENCES compte (id)');
        $this->addSql('CREATE INDEX IDX_3F164B7FB03A8386 ON tontine (created_by_id)');
        $this->addSql('CREATE INDEX IDX_3F164B7FDD7B2EBC ON tontine (edited_by_id)');
        $this->addSql('CREATE INDEX IDX_3F164B7F19EB6921 ON tontine (client_id)');
        $this->addSql('CREATE INDEX IDX_3F164B7FD725330D ON tontine (agence_id)');
        $this->addSql('CREATE INDEX IDX_3F164B7FF2C56620 ON tontine (compte_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tontine DROP FOREIGN KEY FK_3F164B7FF2C56620');
        $this->addSql('DROP TABLE compte');
        $this->addSql('ALTER TABLE tontine DROP FOREIGN KEY FK_3F164B7FB03A8386');
        $this->addSql('ALTER TABLE tontine DROP FOREIGN KEY FK_3F164B7FDD7B2EBC');
        $this->addSql('ALTER TABLE tontine DROP FOREIGN KEY FK_3F164B7F19EB6921');
        $this->addSql('ALTER TABLE tontine DROP FOREIGN KEY FK_3F164B7FD725330D');
        $this->addSql('DROP INDEX IDX_3F164B7FB03A8386 ON tontine');
        $this->addSql('DROP INDEX IDX_3F164B7FDD7B2EBC ON tontine');
        $this->addSql('DROP INDEX IDX_3F164B7F19EB6921 ON tontine');
        $this->addSql('DROP INDEX IDX_3F164B7FD725330D ON tontine');
        $this->addSql('DROP INDEX IDX_3F164B7FF2C56620 ON tontine');
        $this->addSql('ALTER TABLE tontine ADD numclient VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP created_by_id, DROP edited_by_id, DROP client_id, DROP agence_id, DROP compte_id, DROP numton, DROP mcredit, DROP remboursement, DROP avance, DROP interet, DROP feuillet, DROP finfeuillet, DROP numcreditencours, DROP nbmaxappoint, DROP dateraappoint, DROP slug, DROP created_on, DROP edited_on');
    }
}
