<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221116103702 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE loisir_categorie DROP FOREIGN KEY FK_B50551B3BCF5E72D');
        $this->addSql('ALTER TABLE loisir_categorie DROP FOREIGN KEY FK_B50551B3A19C359');
        $this->addSql('ALTER TABLE loisir_pays DROP FOREIGN KEY FK_34E65536A19C359');
        $this->addSql('ALTER TABLE loisir_pays DROP FOREIGN KEY FK_34E65536A6E44244');
        $this->addSql('DROP TABLE loisir_categorie');
        $this->addSql('DROP TABLE loisir_pays');
        $this->addSql('ALTER TABLE loisir ADD pays_id INT DEFAULT NULL, ADD categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE loisir ADD CONSTRAINT FK_CF3B2060A6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id)');
        $this->addSql('ALTER TABLE loisir ADD CONSTRAINT FK_CF3B2060BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_CF3B2060A6E44244 ON loisir (pays_id)');
        $this->addSql('CREATE INDEX IDX_CF3B2060BCF5E72D ON loisir (categorie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE loisir_categorie (loisir_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_B50551B3A19C359 (loisir_id), INDEX IDX_B50551B3BCF5E72D (categorie_id), PRIMARY KEY(loisir_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE loisir_pays (loisir_id INT NOT NULL, pays_id INT NOT NULL, INDEX IDX_34E65536A19C359 (loisir_id), INDEX IDX_34E65536A6E44244 (pays_id), PRIMARY KEY(loisir_id, pays_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE loisir_categorie ADD CONSTRAINT FK_B50551B3BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE loisir_categorie ADD CONSTRAINT FK_B50551B3A19C359 FOREIGN KEY (loisir_id) REFERENCES loisir (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE loisir_pays ADD CONSTRAINT FK_34E65536A19C359 FOREIGN KEY (loisir_id) REFERENCES loisir (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE loisir_pays ADD CONSTRAINT FK_34E65536A6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE loisir DROP FOREIGN KEY FK_CF3B2060A6E44244');
        $this->addSql('ALTER TABLE loisir DROP FOREIGN KEY FK_CF3B2060BCF5E72D');
        $this->addSql('DROP INDEX IDX_CF3B2060A6E44244 ON loisir');
        $this->addSql('DROP INDEX IDX_CF3B2060BCF5E72D ON loisir');
        $this->addSql('ALTER TABLE loisir DROP pays_id, DROP categorie_id');
    }
}
