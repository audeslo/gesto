<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210620220707 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX uniq_3f164b7f96e6776ec1ae4fed');
        $this->addSql('ALTER TABLE tontine RENAME COLUMN numlivret TO ranglivret');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3F164B7F96E6776E6C89DB72 ON tontine (numcomp, ranglivret)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP INDEX UNIQ_3F164B7F96E6776E6C89DB72');
        $this->addSql('ALTER TABLE tontine RENAME COLUMN ranglivret TO numlivret');
        $this->addSql('CREATE UNIQUE INDEX uniq_3f164b7f96e6776ec1ae4fed ON tontine (numcomp, numlivret)');
    }
}
