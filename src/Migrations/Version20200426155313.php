<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200426155313 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE airports (id INT AUTO_INCREMENT NOT NULL, icao_code VARCHAR(4) NOT NULL, UNIQUE INDEX UNIQ_6E1AFD6070DCC949 (icao_code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE conditions (id INT AUTO_INCREMENT NOT NULL, airport_id INT DEFAULT NULL, temperature INT NOT NULL, pressure INT NOT NULL, visibility INT NOT NULL, INDEX IDX_F46609A9289F53C8 (airport_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE winds (id INT AUTO_INCREMENT NOT NULL, airport_id INT DEFAULT NULL, heading INT NOT NULL, speed INT NOT NULL, gusts INT NOT NULL, runway VARCHAR(3) DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_412A1B44289F53C8 (airport_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE conditions ADD CONSTRAINT FK_F46609A9289F53C8 FOREIGN KEY (airport_id) REFERENCES airports (id)');
        $this->addSql('ALTER TABLE winds ADD CONSTRAINT FK_412A1B44289F53C8 FOREIGN KEY (airport_id) REFERENCES airports (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE conditions DROP FOREIGN KEY FK_F46609A9289F53C8');
        $this->addSql('ALTER TABLE winds DROP FOREIGN KEY FK_412A1B44289F53C8');
        $this->addSql('DROP TABLE airports');
        $this->addSql('DROP TABLE conditions');
        $this->addSql('DROP TABLE winds');
    }
}
