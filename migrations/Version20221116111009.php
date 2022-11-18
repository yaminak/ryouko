<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221116111009 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE hobbies (id INT AUTO_INCREMENT NOT NULL, pays_id INT NOT NULL, categorie_id INT NOT NULL, loisir LONGTEXT NOT NULL, INDEX IDX_38CA341DA6E44244 (pays_id), INDEX IDX_38CA341DBCF5E72D (categorie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE hobbies ADD CONSTRAINT FK_38CA341DA6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id)');
        $this->addSql('ALTER TABLE hobbies ADD CONSTRAINT FK_38CA341DBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE loisir DROP FOREIGN KEY FK_CF3B2060BCF5E72D');
        $this->addSql('ALTER TABLE loisir DROP FOREIGN KEY FK_CF3B2060A6E44244');
        $this->addSql('DROP TABLE loisir');
        $this->addSql('ALTER TABLE categorie CHANGE intitule intitule LONGTEXT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE loisir (id INT AUTO_INCREMENT NOT NULL, pays_id INT DEFAULT NULL, categorie_id INT DEFAULT NULL, activite LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, photo LONGTEXT CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, culture LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, excursion LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_CF3B2060BCF5E72D (categorie_id), INDEX IDX_CF3B2060A6E44244 (pays_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE loisir ADD CONSTRAINT FK_CF3B2060BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE loisir ADD CONSTRAINT FK_CF3B2060A6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id)');
        $this->addSql('ALTER TABLE hobbies DROP FOREIGN KEY FK_38CA341DA6E44244');
        $this->addSql('ALTER TABLE hobbies DROP FOREIGN KEY FK_38CA341DBCF5E72D');
        $this->addSql('DROP TABLE hobbies');
        $this->addSql('ALTER TABLE categorie CHANGE intitule intitule VARCHAR(255) NOT NULL');
    }
}
