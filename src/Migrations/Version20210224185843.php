<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210224185843 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE tournament_result 
            ADD CONSTRAINT FK_77C03F4333D1A3E7 
                FOREIGN KEY (tournament_id) REFERENCES tournament (id)'
        );
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('ALTER TABLE DROP CONSTRAINT FK_77C03F4333D1A3E7');
    }
}
