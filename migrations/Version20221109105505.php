<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221109105505 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pays_culture (id INT AUTO_INCREMENT NOT NULL, pays_id INT DEFAULT NULL, culture_id INT DEFAULT NULL, INDEX IDX_AA74FDDEA6E44244 (pays_id), INDEX IDX_AA74FDDEB108249D (culture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pays_excursion (id INT AUTO_INCREMENT NOT NULL, pays_id INT DEFAULT NULL, excursion_id INT DEFAULT NULL, INDEX IDX_38C688AA6E44244 (pays_id), INDEX IDX_38C688A4AB4296F (excursion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pays_culture ADD CONSTRAINT FK_AA74FDDEA6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id)');
        $this->addSql('ALTER TABLE pays_culture ADD CONSTRAINT FK_AA74FDDEB108249D FOREIGN KEY (culture_id) REFERENCES culture (id)');
        $this->addSql('ALTER TABLE pays_excursion ADD CONSTRAINT FK_38C688AA6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id)');
        $this->addSql('ALTER TABLE pays_excursion ADD CONSTRAINT FK_38C688A4AB4296F FOREIGN KEY (excursion_id) REFERENCES excursion (id)');
        $this->addSql('ALTER TABLE culture ADD categorie VARCHAR(255) NOT NULL, ADD intitule VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pays_culture DROP FOREIGN KEY FK_AA74FDDEA6E44244');
        $this->addSql('ALTER TABLE pays_culture DROP FOREIGN KEY FK_AA74FDDEB108249D');
        $this->addSql('ALTER TABLE pays_excursion DROP FOREIGN KEY FK_38C688AA6E44244');
        $this->addSql('ALTER TABLE pays_excursion DROP FOREIGN KEY FK_38C688A4AB4296F');
        $this->addSql('DROP TABLE pays_culture');
        $this->addSql('DROP TABLE pays_excursion');
        $this->addSql('ALTER TABLE culture DROP categorie, DROP intitule');
    }
}
