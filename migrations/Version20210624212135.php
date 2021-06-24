<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210624212135 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE operation ALTER created_on TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE operation ALTER created_on DROP DEFAULT');
        $this->addSql('ALTER TABLE operation ALTER created_on SET NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE operation ALTER created_on TYPE DATE');
        $this->addSql('ALTER TABLE operation ALTER created_on DROP DEFAULT');
        $this->addSql('ALTER TABLE operation ALTER created_on DROP NOT NULL');
    }
}
