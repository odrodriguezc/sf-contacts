<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200817131852 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact_entity ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE contact_entity ADD CONSTRAINT FK_9EBA73E9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_9EBA73E9A76ED395 ON contact_entity (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact_entity DROP FOREIGN KEY FK_9EBA73E9A76ED395');
        $this->addSql('DROP INDEX IDX_9EBA73E9A76ED395 ON contact_entity');
        $this->addSql('ALTER TABLE contact_entity DROP user_id');
    }
}
