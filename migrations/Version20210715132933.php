<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210715132933 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE parametre ADD created_by_id INT NOT NULL');
        $this->addSql('ALTER TABLE parametre ADD edited_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE parametre ADD slug VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE parametre ADD created_on TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE parametre ADD edited_on TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE parametre ADD CONSTRAINT FK_ACC79041B03A8386 FOREIGN KEY (created_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE parametre ADD CONSTRAINT FK_ACC79041DD7B2EBC FOREIGN KEY (edited_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_ACC79041B03A8386 ON parametre (created_by_id)');
        $this->addSql('CREATE INDEX IDX_ACC79041DD7B2EBC ON parametre (edited_by_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE parametre DROP CONSTRAINT FK_ACC79041B03A8386');
        $this->addSql('ALTER TABLE parametre DROP CONSTRAINT FK_ACC79041DD7B2EBC');
        $this->addSql('DROP INDEX IDX_ACC79041B03A8386');
        $this->addSql('DROP INDEX IDX_ACC79041DD7B2EBC');
        $this->addSql('ALTER TABLE parametre DROP created_by_id');
        $this->addSql('ALTER TABLE parametre DROP edited_by_id');
        $this->addSql('ALTER TABLE parametre DROP slug');
        $this->addSql('ALTER TABLE parametre DROP created_on');
        $this->addSql('ALTER TABLE parametre DROP edited_on');
    }
}
