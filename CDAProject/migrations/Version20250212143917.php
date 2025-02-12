<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250212143917 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE "user" ALTER size DROP NOT NULL');
        $this->addSql('ALTER TABLE "user" ALTER age DROP NOT NULL');
        $this->addSql('ALTER TABLE "user" ALTER sexe DROP NOT NULL');
        $this->addSql('ALTER TABLE "user" ALTER weight DROP NOT NULL');
        $this->addSql('ALTER TABLE "user" ALTER level DROP NOT NULL');
        $this->addSql('ALTER TABLE "user" ALTER week_activity DROP NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "user" ALTER size SET NOT NULL');
        $this->addSql('ALTER TABLE "user" ALTER age SET NOT NULL');
        $this->addSql('ALTER TABLE "user" ALTER sexe SET NOT NULL');
        $this->addSql('ALTER TABLE "user" ALTER weight SET NOT NULL');
        $this->addSql('ALTER TABLE "user" ALTER level SET NOT NULL');
        $this->addSql('ALTER TABLE "user" ALTER week_activity SET NOT NULL');
    }
}
