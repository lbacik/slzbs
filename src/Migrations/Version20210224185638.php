<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210224185638 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.'
        );

        $this->addSql('CREATE TABLE news (
          id CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:guid)\',
          content LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`,
          published TINYINT(1) DEFAULT \'0\' NOT NULL,
          date DATETIME DEFAULT NULL,
          created DATETIME DEFAULT NULL,
          updated DATETIME DEFAULT NULL,
          PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\'');

        $this->addSql('CREATE TABLE tournament (
          id CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:guid)\',
          name VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`,
          description VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`,
          published TINYINT(1) DEFAULT \'0\' NOT NULL,
          date DATETIME DEFAULT NULL,
          created DATETIME DEFAULT NULL,
          updated DATETIME DEFAULT NULL,
          PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\'');

        $this->addSql('CREATE TABLE tournament_result (
          id INT AUTO_INCREMENT NOT NULL,
          tournament_id CHAR(36) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:guid)\',
          name VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`,
          link VARCHAR(128) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`,
          published TINYINT(1) DEFAULT \'0\' NOT NULL,
          created DATETIME DEFAULT NULL,
          INDEX IDX_77C03F4333D1A3E7 (tournament_id),
          PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\'');
    }

    public function down(Schema $schema) : void
    {
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.'
        );

        $this->addSql('DROP TABLE news');
        $this->addSql('DROP TABLE tournament');
        $this->addSql('DROP TABLE tournament_result');
    }
}
