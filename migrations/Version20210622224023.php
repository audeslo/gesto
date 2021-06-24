<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210622224023 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE operation DROP CONSTRAINT fk_1981a66ddeb5c9fd');
        $this->addSql('DROP INDEX idx_1981a66ddeb5c9fd');
        $this->addSql('ALTER TABLE operation ADD sens VARCHAR(16) NOT NULL');
        $this->addSql('ALTER TABLE operation DROP tontine_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE operation ADD tontine_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE operation DROP sens');
        $this->addSql('ALTER TABLE operation ADD CONSTRAINT fk_1981a66ddeb5c9fd FOREIGN KEY (tontine_id) REFERENCES tontine (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_1981a66ddeb5c9fd ON operation (tontine_id)');
    }
}
