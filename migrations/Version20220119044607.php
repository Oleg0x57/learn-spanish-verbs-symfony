<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220119044607 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE abstract_time_form_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE infinitivo_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE abstract_time_form (id INT NOT NULL, infinitivo_id INT NOT NULL, yo VARCHAR(255) NOT NULL, tu VARCHAR(255) NOT NULL, el VARCHAR(255) NOT NULL, ella VARCHAR(255) NOT NULL, usted VARCHAR(255) NOT NULL, nosotros VARCHAR(255) NOT NULL, vosotros VARCHAR(255) NOT NULL, ellos VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2AA518A232ECFFF7 ON abstract_time_form (infinitivo_id)');
        $this->addSql('CREATE TABLE infinitivo (id INT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE abstract_time_form ADD CONSTRAINT FK_2AA518A232ECFFF7 FOREIGN KEY (infinitivo_id) REFERENCES infinitivo (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE abstract_time_form DROP CONSTRAINT FK_2AA518A232ECFFF7');
        $this->addSql('DROP SEQUENCE abstract_time_form_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE infinitivo_id_seq CASCADE');
        $this->addSql('DROP TABLE abstract_time_form');
        $this->addSql('DROP TABLE infinitivo');
    }
}
