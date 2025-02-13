<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250213131449 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE program ADD image VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE program ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE program ALTER difficulty DROP NOT NULL');
        $this->addSql('ALTER TABLE program ALTER duration DROP NOT NULL');
        $this->addSql('ALTER TABLE program ALTER price DROP NOT NULL');
        $this->addSql('ALTER TABLE program ALTER is_custom DROP NOT NULL');
        $this->addSql('ALTER TABLE program RENAME COLUMN name TO title');
        $this->addSql('COMMENT ON COLUMN program.created_at IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE program DROP image');
        $this->addSql('ALTER TABLE program DROP created_at');
        $this->addSql('ALTER TABLE program ALTER difficulty SET NOT NULL');
        $this->addSql('ALTER TABLE program ALTER duration SET NOT NULL');
        $this->addSql('ALTER TABLE program ALTER price SET NOT NULL');
        $this->addSql('ALTER TABLE program ALTER is_custom SET NOT NULL');
        $this->addSql('ALTER TABLE program RENAME COLUMN title TO name');
    }
}
