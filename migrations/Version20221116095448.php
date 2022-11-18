<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221116095448 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, intitule VARCHAR(255) NOT NULL, categorie VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE loisir (id INT AUTO_INCREMENT NOT NULL, activite LONGTEXT NOT NULL, photo LONGTEXT DEFAULT NULL, culture LONGTEXT NOT NULL, excursion LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE loisir_pays (loisir_id INT NOT NULL, pays_id INT NOT NULL, INDEX IDX_34E65536A19C359 (loisir_id), INDEX IDX_34E65536A6E44244 (pays_id), PRIMARY KEY(loisir_id, pays_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE loisir_categorie (loisir_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_B50551B3A19C359 (loisir_id), INDEX IDX_B50551B3BCF5E72D (categorie_id), PRIMARY KEY(loisir_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE loisir_pays ADD CONSTRAINT FK_34E65536A19C359 FOREIGN KEY (loisir_id) REFERENCES loisir (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE loisir_pays ADD CONSTRAINT FK_34E65536A6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE loisir_categorie ADD CONSTRAINT FK_B50551B3A19C359 FOREIGN KEY (loisir_id) REFERENCES loisir (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE loisir_categorie ADD CONSTRAINT FK_B50551B3BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pays_activite DROP FOREIGN KEY FK_EEDA4C579B0F88B1');
        $this->addSql('ALTER TABLE pays_activite DROP FOREIGN KEY FK_EEDA4C57A6E44244');
        $this->addSql('ALTER TABLE pays_culture DROP FOREIGN KEY FK_AA74FDDEB108249D');
        $this->addSql('ALTER TABLE pays_culture DROP FOREIGN KEY FK_AA74FDDEA6E44244');
        $this->addSql('ALTER TABLE pays_excursion DROP FOREIGN KEY FK_38C688AA6E44244');
        $this->addSql('ALTER TABLE pays_excursion DROP FOREIGN KEY FK_38C688A4AB4296F');
        $this->addSql('DROP TABLE activite');
        $this->addSql('DROP TABLE culture');
        $this->addSql('DROP TABLE excursion');
        $this->addSql('DROP TABLE pays_activite');
        $this->addSql('DROP TABLE pays_culture');
        $this->addSql('DROP TABLE pays_excursion');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activite (id INT AUTO_INCREMENT NOT NULL, categorie VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, intitule VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE culture (id INT AUTO_INCREMENT NOT NULL, langue VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, art LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, patrimoine LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, point_fort LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, point_faible LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, gastronomie LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, categorie VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, intitule VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE excursion (id INT AUTO_INCREMENT NOT NULL, montagne LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, foret LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, plage LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ville LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE pays_activite (id INT AUTO_INCREMENT NOT NULL, pays_id INT NOT NULL, activite_id INT NOT NULL, INDEX IDX_EEDA4C579B0F88B1 (activite_id), INDEX IDX_EEDA4C57A6E44244 (pays_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE pays_culture (id INT AUTO_INCREMENT NOT NULL, pays_id INT DEFAULT NULL, culture_id INT DEFAULT NULL, INDEX IDX_AA74FDDEB108249D (culture_id), INDEX IDX_AA74FDDEA6E44244 (pays_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE pays_excursion (id INT AUTO_INCREMENT NOT NULL, pays_id INT DEFAULT NULL, excursion_id INT DEFAULT NULL, INDEX IDX_38C688A4AB4296F (excursion_id), INDEX IDX_38C688AA6E44244 (pays_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE pays_activite ADD CONSTRAINT FK_EEDA4C579B0F88B1 FOREIGN KEY (activite_id) REFERENCES activite (id)');
        $this->addSql('ALTER TABLE pays_activite ADD CONSTRAINT FK_EEDA4C57A6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id)');
        $this->addSql('ALTER TABLE pays_culture ADD CONSTRAINT FK_AA74FDDEB108249D FOREIGN KEY (culture_id) REFERENCES culture (id)');
        $this->addSql('ALTER TABLE pays_culture ADD CONSTRAINT FK_AA74FDDEA6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id)');
        $this->addSql('ALTER TABLE pays_excursion ADD CONSTRAINT FK_38C688AA6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id)');
        $this->addSql('ALTER TABLE pays_excursion ADD CONSTRAINT FK_38C688A4AB4296F FOREIGN KEY (excursion_id) REFERENCES excursion (id)');
        $this->addSql('ALTER TABLE loisir_pays DROP FOREIGN KEY FK_34E65536A19C359');
        $this->addSql('ALTER TABLE loisir_pays DROP FOREIGN KEY FK_34E65536A6E44244');
        $this->addSql('ALTER TABLE loisir_categorie DROP FOREIGN KEY FK_B50551B3A19C359');
        $this->addSql('ALTER TABLE loisir_categorie DROP FOREIGN KEY FK_B50551B3BCF5E72D');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE loisir');
        $this->addSql('DROP TABLE loisir_pays');
        $this->addSql('DROP TABLE loisir_categorie');
    }
}
