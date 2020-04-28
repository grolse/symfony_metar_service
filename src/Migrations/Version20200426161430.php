<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200426161430 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE conditions DROP FOREIGN KEY FK_F46609A9289F53C8');
        $this->addSql('ALTER TABLE winds DROP FOREIGN KEY FK_412A1B44289F53C8');
        $this->addSql('CREATE TABLE weather (id INT AUTO_INCREMENT NOT NULL, icao_code VARCHAR(4) NOT NULL, UNIQUE INDEX UNIQ_4CD0D36E70DCC949 (icao_code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE airports');
        $this->addSql('DROP INDEX IDX_F46609A9289F53C8 ON conditions');
        $this->addSql('ALTER TABLE conditions ADD weather_id INT DEFAULT NULL, DROP airport_id');
        $this->addSql('ALTER TABLE conditions ADD CONSTRAINT FK_F46609A98CE675E FOREIGN KEY (weather_id) REFERENCES weather (id)');
        $this->addSql('CREATE INDEX IDX_F46609A98CE675E ON conditions (weather_id)');
        $this->addSql('DROP INDEX IDX_412A1B44289F53C8 ON winds');
        $this->addSql('ALTER TABLE winds ADD weather_id INT DEFAULT NULL, DROP airport_id, CHANGE runway runway VARCHAR(3) DEFAULT NULL');
        $this->addSql('ALTER TABLE winds ADD CONSTRAINT FK_412A1B448CE675E FOREIGN KEY (weather_id) REFERENCES weather (id)');
        $this->addSql('CREATE INDEX IDX_412A1B448CE675E ON winds (weather_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE conditions DROP FOREIGN KEY FK_F46609A98CE675E');
        $this->addSql('ALTER TABLE winds DROP FOREIGN KEY FK_412A1B448CE675E');
        $this->addSql('CREATE TABLE airports (id INT AUTO_INCREMENT NOT NULL, icao_code VARCHAR(4) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_6E1AFD6070DCC949 (icao_code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE weather');
        $this->addSql('DROP INDEX IDX_F46609A98CE675E ON conditions');
        $this->addSql('ALTER TABLE conditions ADD airport_id INT DEFAULT NULL, DROP weather_id');
        $this->addSql('ALTER TABLE conditions ADD CONSTRAINT FK_F46609A9289F53C8 FOREIGN KEY (airport_id) REFERENCES airports (id)');
        $this->addSql('CREATE INDEX IDX_F46609A9289F53C8 ON conditions (airport_id)');
        $this->addSql('DROP INDEX IDX_412A1B448CE675E ON winds');
        $this->addSql('ALTER TABLE winds ADD airport_id INT DEFAULT NULL, DROP weather_id, CHANGE runway runway VARCHAR(3) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE winds ADD CONSTRAINT FK_412A1B44289F53C8 FOREIGN KEY (airport_id) REFERENCES airports (id)');
        $this->addSql('CREATE INDEX IDX_412A1B44289F53C8 ON winds (airport_id)');
    }
}
