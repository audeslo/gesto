<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210620214811 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE detailtontine ADD tontine_id INT NOT NULL');
        $this->addSql('ALTER TABLE detailtontine ADD client_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE detailtontine ADD CONSTRAINT FK_D4EFB567DEB5C9FD FOREIGN KEY (tontine_id) REFERENCES tontine (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE detailtontine ADD CONSTRAINT FK_D4EFB56719EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_D4EFB567DEB5C9FD ON detailtontine (tontine_id)');
        $this->addSql('CREATE INDEX IDX_D4EFB56719EB6921 ON detailtontine (client_id)');
        $this->addSql('ALTER TABLE operation ADD nomcomplet VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE operation DROP nomcomplet');
        $this->addSql('ALTER TABLE detailtontine DROP CONSTRAINT FK_D4EFB567DEB5C9FD');
        $this->addSql('ALTER TABLE detailtontine DROP CONSTRAINT FK_D4EFB56719EB6921');
        $this->addSql('DROP INDEX IDX_D4EFB567DEB5C9FD');
        $this->addSql('DROP INDEX IDX_D4EFB56719EB6921');
        $this->addSql('ALTER TABLE detailtontine DROP tontine_id');
        $this->addSql('ALTER TABLE detailtontine DROP client_id');
    }
}
