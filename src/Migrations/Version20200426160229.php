<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200426160229 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE conditions ADD raw_metar VARCHAR(255) NOT NULL, CHANGE airport_id airport_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE winds CHANGE airport_id airport_id INT DEFAULT NULL, CHANGE runway runway VARCHAR(3) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE conditions DROP raw_metar, CHANGE airport_id airport_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE winds CHANGE airport_id airport_id INT DEFAULT NULL, CHANGE runway runway VARCHAR(3) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
    }
}
