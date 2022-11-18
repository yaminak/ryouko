<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221116111803 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie ADD description LONGTEXT DEFAULT NULL, CHANGE intitule intitule VARCHAR(150) NOT NULL');
        $this->addSql('ALTER TABLE hobbies CHANGE loisir loisir VARCHAR(50) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie DROP description, CHANGE intitule intitule LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE hobbies CHANGE loisir loisir LONGTEXT NOT NULL');
    }
}
