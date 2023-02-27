<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230227151447 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP civilite, DROP prenom, DROP nom, DROP adresse, DROP code_postal, DROP ville');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD civilite VARCHAR(50) DEFAULT NULL, ADD prenom VARCHAR(150) DEFAULT NULL, ADD nom VARCHAR(150) DEFAULT NULL, ADD adresse VARCHAR(255) DEFAULT NULL, ADD code_postal VARCHAR(5) DEFAULT NULL, ADD ville VARCHAR(150) DEFAULT NULL');
    }
}
