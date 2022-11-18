<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221107155250 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activite (id INT AUTO_INCREMENT NOT NULL, festival LONGTEXT NOT NULL, parc LONGTEXT NOT NULL, sensation LONGTEXT NOT NULL, nautique LONGTEXT NOT NULL, exhibition LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, commentaire LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE culture (id INT AUTO_INCREMENT NOT NULL, pays_id INT NOT NULL, langue VARCHAR(50) NOT NULL, art LONGTEXT NOT NULL, patrimoine LONGTEXT NOT NULL, point_fort LONGTEXT NOT NULL, point_faible LONGTEXT NOT NULL, gastronomie LONGTEXT NOT NULL, INDEX IDX_B6A99CEBA6E44244 (pays_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE excursion (id INT AUTO_INCREMENT NOT NULL, montagne LONGTEXT NOT NULL, foret LONGTEXT NOT NULL, plage LONGTEXT NOT NULL, ville LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pays (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, drapeau LONGTEXT NOT NULL, population INT DEFAULT NULL, paysage LONGTEXT NOT NULL, description LONGTEXT DEFAULT NULL, superficie VARCHAR(90) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pays_activite (pays_id INT NOT NULL, activite_id INT NOT NULL, INDEX IDX_EEDA4C57A6E44244 (pays_id), INDEX IDX_EEDA4C579B0F88B1 (activite_id), PRIMARY KEY(pays_id, activite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pays_excursion (pays_id INT NOT NULL, excursion_id INT NOT NULL, INDEX IDX_38C688AA6E44244 (pays_id), INDEX IDX_38C688A4AB4296F (excursion_id), PRIMARY KEY(pays_id, excursion_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE culture ADD CONSTRAINT FK_B6A99CEBA6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id)');
        $this->addSql('ALTER TABLE pays_activite ADD CONSTRAINT FK_EEDA4C57A6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pays_activite ADD CONSTRAINT FK_EEDA4C579B0F88B1 FOREIGN KEY (activite_id) REFERENCES activite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pays_excursion ADD CONSTRAINT FK_38C688AA6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pays_excursion ADD CONSTRAINT FK_38C688A4AB4296F FOREIGN KEY (excursion_id) REFERENCES excursion (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE culture DROP FOREIGN KEY FK_B6A99CEBA6E44244');
        $this->addSql('ALTER TABLE pays_activite DROP FOREIGN KEY FK_EEDA4C57A6E44244');
        $this->addSql('ALTER TABLE pays_activite DROP FOREIGN KEY FK_EEDA4C579B0F88B1');
        $this->addSql('ALTER TABLE pays_excursion DROP FOREIGN KEY FK_38C688AA6E44244');
        $this->addSql('ALTER TABLE pays_excursion DROP FOREIGN KEY FK_38C688A4AB4296F');
        $this->addSql('DROP TABLE activite');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE culture');
        $this->addSql('DROP TABLE excursion');
        $this->addSql('DROP TABLE pays');
        $this->addSql('DROP TABLE pays_activite');
        $this->addSql('DROP TABLE pays_excursion');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
