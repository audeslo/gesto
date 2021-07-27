<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210721100753 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE collecte DROP CONSTRAINT fk_55ae4a3d428a7084');
        $this->addSql('DROP INDEX uniq_55ae4a3d428a7084');
        $this->addSql('ALTER TABLE collecte RENAME COLUMN operaton_id TO operation_id');
        $this->addSql('ALTER TABLE collecte ADD CONSTRAINT FK_55AE4A3D44AC3583 FOREIGN KEY (operation_id) REFERENCES operation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_55AE4A3D44AC3583 ON collecte (operation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE collecte DROP CONSTRAINT FK_55AE4A3D44AC3583');
        $this->addSql('DROP INDEX UNIQ_55AE4A3D44AC3583');
        $this->addSql('ALTER TABLE collecte RENAME COLUMN operation_id TO operaton_id');
        $this->addSql('ALTER TABLE collecte ADD CONSTRAINT fk_55ae4a3d428a7084 FOREIGN KEY (operaton_id) REFERENCES operation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX uniq_55ae4a3d428a7084 ON collecte (operaton_id)');
    }
}
