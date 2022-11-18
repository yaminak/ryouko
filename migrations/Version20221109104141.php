<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221109104141 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE pays_user (id INT AUTO_INCREMENT NOT NULL, pays_id INT DEFAULT NULL, user_id INT DEFAULT NULL, INDEX IDX_E839CC86A6E44244 (pays_id), INDEX IDX_E839CC86A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE pays_user ADD CONSTRAINT FK_E839CC86A6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id)');
        $this->addSql('ALTER TABLE pays_user ADD CONSTRAINT FK_E839CC86A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commentaire CHANGE message message LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE pays_user DROP FOREIGN KEY FK_E839CC86A6E44244');
        $this->addSql('ALTER TABLE pays_user DROP FOREIGN KEY FK_E839CC86A76ED395');
        $this->addSql('DROP TABLE pays_user');
        $this->addSql('ALTER TABLE commentaire CHANGE message message VARCHAR(255) DEFAULT NULL');
    }
}
