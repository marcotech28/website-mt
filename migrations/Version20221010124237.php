<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221010124237 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, descriptio_courte VARCHAR(255) NOT NULL, description_courte VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, video1 LONGTEXT DEFAULT NULL, video2 LONGTEXT DEFAULT NULL, fiche_descriptive LONGTEXT DEFAULT NULL, caracteristiques LONGTEXT NOT NULL, prix_ht DOUBLE PRECISION NOT NULL, fiche_tarif_prod VARCHAR(255) DEFAULT NULL, image1 LONGTEXT DEFAULT NULL, image2 LONGTEXT DEFAULT NULL, image3 LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE produit');
    }
}
