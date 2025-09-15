<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250825105358 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id SERIAL NOT NULL, user_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, state VARCHAR(255) NOT NULL, picture VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_23A0E66A76ED395 ON article (user_id)');
        $this->addSql('COMMENT ON COLUMN article.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE article_category (article_id INT NOT NULL, category_id INT NOT NULL, PRIMARY KEY(article_id, category_id))');
        $this->addSql('CREATE INDEX IDX_53A4EDAA7294869C ON article_category (article_id)');
        $this->addSql('CREATE INDEX IDX_53A4EDAA12469DE2 ON article_category (category_id)');
        $this->addSql('CREATE TABLE category (id SERIAL NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE exercice (id SERIAL NOT NULL, program_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, duration DOUBLE PRECISION NOT NULL, session VARCHAR(255) NOT NULL, week VARCHAR(255) NOT NULL, difficulty VARCHAR(255) NOT NULL, duration_in_minutes INT NOT NULL, equipment TEXT DEFAULT NULL, instructions TEXT NOT NULL, variations JSON DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E418C74D3EB8070A ON exercice (program_id)');
        $this->addSql('CREATE TABLE program (id SERIAL NOT NULL, user_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description TEXT NOT NULL, image VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, difficulty VARCHAR(50) DEFAULT NULL, duration DOUBLE PRECISION DEFAULT NULL, price DOUBLE PRECISION DEFAULT NULL, is_custom BOOLEAN DEFAULT NULL, slug VARCHAR(255) NOT NULL, state VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_92ED7784A76ED395 ON program (user_id)');
        $this->addSql('COMMENT ON COLUMN program.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE program_week (id SERIAL NOT NULL, program_id INT NOT NULL, week_number INT NOT NULL, title VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_56BC3CC73EB8070A ON program_week (program_id)');
        $this->addSql('CREATE TABLE program_week_exercice (program_week_id INT NOT NULL, exercice_id INT NOT NULL, PRIMARY KEY(program_week_id, exercice_id))');
        $this->addSql('CREATE INDEX IDX_F91E64A04385C3FB ON program_week_exercice (program_week_id)');
        $this->addSql('CREATE INDEX IDX_F91E64A089D40298 ON program_week_exercice (exercice_id)');
        $this->addSql('CREATE TABLE "user" (id SERIAL NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, lastname VARCHAR(100) NOT NULL, firstname VARCHAR(100) NOT NULL, size DOUBLE PRECISION DEFAULT NULL, age DOUBLE PRECISION DEFAULT NULL, sexe VARCHAR(255) DEFAULT NULL, weight DOUBLE PRECISION DEFAULT NULL, level VARCHAR(20) DEFAULT NULL, week_activity DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON "user" (email)');
        $this->addSql('CREATE TABLE user_exercice (user_id INT NOT NULL, exercice_id INT NOT NULL, PRIMARY KEY(user_id, exercice_id))');
        $this->addSql('CREATE INDEX IDX_495234DA76ED395 ON user_exercice (user_id)');
        $this->addSql('CREATE INDEX IDX_495234D89D40298 ON user_exercice (exercice_id)');
        $this->addSql('CREATE TABLE user_program (user_id INT NOT NULL, program_id INT NOT NULL, PRIMARY KEY(user_id, program_id))');
        $this->addSql('CREATE INDEX IDX_CAE0698EA76ED395 ON user_program (user_id)');
        $this->addSql('CREATE INDEX IDX_CAE0698E3EB8070A ON user_program (program_id)');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE article_category ADD CONSTRAINT FK_53A4EDAA7294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE article_category ADD CONSTRAINT FK_53A4EDAA12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE exercice ADD CONSTRAINT FK_E418C74D3EB8070A FOREIGN KEY (program_id) REFERENCES program (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE program ADD CONSTRAINT FK_92ED7784A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE program_week ADD CONSTRAINT FK_56BC3CC73EB8070A FOREIGN KEY (program_id) REFERENCES program (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE program_week_exercice ADD CONSTRAINT FK_F91E64A04385C3FB FOREIGN KEY (program_week_id) REFERENCES program_week (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE program_week_exercice ADD CONSTRAINT FK_F91E64A089D40298 FOREIGN KEY (exercice_id) REFERENCES exercice (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_exercice ADD CONSTRAINT FK_495234DA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_exercice ADD CONSTRAINT FK_495234D89D40298 FOREIGN KEY (exercice_id) REFERENCES exercice (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_program ADD CONSTRAINT FK_CAE0698EA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_program ADD CONSTRAINT FK_CAE0698E3EB8070A FOREIGN KEY (program_id) REFERENCES program (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE article DROP CONSTRAINT FK_23A0E66A76ED395');
        $this->addSql('ALTER TABLE article_category DROP CONSTRAINT FK_53A4EDAA7294869C');
        $this->addSql('ALTER TABLE article_category DROP CONSTRAINT FK_53A4EDAA12469DE2');
        $this->addSql('ALTER TABLE exercice DROP CONSTRAINT FK_E418C74D3EB8070A');
        $this->addSql('ALTER TABLE program DROP CONSTRAINT FK_92ED7784A76ED395');
        $this->addSql('ALTER TABLE program_week DROP CONSTRAINT FK_56BC3CC73EB8070A');
        $this->addSql('ALTER TABLE program_week_exercice DROP CONSTRAINT FK_F91E64A04385C3FB');
        $this->addSql('ALTER TABLE program_week_exercice DROP CONSTRAINT FK_F91E64A089D40298');
        $this->addSql('ALTER TABLE user_exercice DROP CONSTRAINT FK_495234DA76ED395');
        $this->addSql('ALTER TABLE user_exercice DROP CONSTRAINT FK_495234D89D40298');
        $this->addSql('ALTER TABLE user_program DROP CONSTRAINT FK_CAE0698EA76ED395');
        $this->addSql('ALTER TABLE user_program DROP CONSTRAINT FK_CAE0698E3EB8070A');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE article_category');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE exercice');
        $this->addSql('DROP TABLE program');
        $this->addSql('DROP TABLE program_week');
        $this->addSql('DROP TABLE program_week_exercice');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE user_exercice');
        $this->addSql('DROP TABLE user_program');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
