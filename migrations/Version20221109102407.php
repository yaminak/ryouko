<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221109102407 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pays_excursion DROP FOREIGN KEY FK_38C688A4AB4296F');
        $this->addSql('ALTER TABLE pays_excursion DROP FOREIGN KEY FK_38C688AA6E44244');
        $this->addSql('DROP TABLE pays_excursion');
        $this->addSql('ALTER TABLE activite ADD categorie VARCHAR(255) DEFAULT NULL, ADD intitule VARCHAR(255) DEFAULT NULL, DROP festival, DROP parc, DROP sensation, DROP nautique, DROP exhibition');
        $this->addSql('ALTER TABLE commentaire ADD user_id INT DEFAULT NULL, ADD message VARCHAR(255) DEFAULT NULL, DROP commentaire');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_67F068BCA76ED395 ON commentaire (user_id)');
        $this->addSql('ALTER TABLE culture DROP FOREIGN KEY FK_B6A99CEBA6E44244');
        $this->addSql('DROP INDEX IDX_B6A99CEBA6E44244 ON culture');
        $this->addSql('ALTER TABLE culture DROP pays_id');
        $this->addSql('ALTER TABLE pays_activite DROP FOREIGN KEY FK_EEDA4C579B0F88B1');
        $this->addSql('ALTER TABLE pays_activite DROP FOREIGN KEY FK_EEDA4C57A6E44244');
        $this->addSql('ALTER TABLE pays_activite ADD id INT AUTO_INCREMENT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE pays_activite ADD CONSTRAINT FK_EEDA4C579B0F88B1 FOREIGN KEY (activite_id) REFERENCES activite (id)');
        $this->addSql('ALTER TABLE pays_activite ADD CONSTRAINT FK_EEDA4C57A6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCA76ED395');
        $this->addSql('CREATE TABLE pays_excursion (pays_id INT NOT NULL, excursion_id INT NOT NULL, INDEX IDX_38C688AA6E44244 (pays_id), INDEX IDX_38C688A4AB4296F (excursion_id), PRIMARY KEY(pays_id, excursion_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE pays_excursion ADD CONSTRAINT FK_38C688A4AB4296F FOREIGN KEY (excursion_id) REFERENCES excursion (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pays_excursion ADD CONSTRAINT FK_38C688AA6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE activite ADD festival LONGTEXT NOT NULL, ADD parc LONGTEXT NOT NULL, ADD sensation LONGTEXT NOT NULL, ADD nautique LONGTEXT NOT NULL, ADD exhibition LONGTEXT NOT NULL, DROP categorie, DROP intitule');
        $this->addSql('DROP INDEX IDX_67F068BCA76ED395 ON commentaire');
        $this->addSql('ALTER TABLE commentaire ADD commentaire LONGTEXT DEFAULT NULL, DROP user_id, DROP message');
        $this->addSql('ALTER TABLE culture ADD pays_id INT NOT NULL');
        $this->addSql('ALTER TABLE culture ADD CONSTRAINT FK_B6A99CEBA6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id)');
        $this->addSql('CREATE INDEX IDX_B6A99CEBA6E44244 ON culture (pays_id)');
        $this->addSql('ALTER TABLE pays_activite MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE pays_activite DROP FOREIGN KEY FK_EEDA4C57A6E44244');
        $this->addSql('ALTER TABLE pays_activite DROP FOREIGN KEY FK_EEDA4C579B0F88B1');
        $this->addSql('DROP INDEX `PRIMARY` ON pays_activite');
        $this->addSql('ALTER TABLE pays_activite DROP id');
        $this->addSql('ALTER TABLE pays_activite ADD CONSTRAINT FK_EEDA4C57A6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pays_activite ADD CONSTRAINT FK_EEDA4C579B0F88B1 FOREIGN KEY (activite_id) REFERENCES activite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pays_activite ADD PRIMARY KEY (pays_id, activite_id)');
    }
}
