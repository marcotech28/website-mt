<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221109100546 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit ADD description_courte LONGTEXT NOT NULL, ADD video1 LONGTEXT DEFAULT NULL, ADD video2 LONGTEXT DEFAULT NULL, ADD fiche_descriptive LONGTEXT DEFAULT NULL, ADD caracteristiques LONGTEXT DEFAULT NULL, ADD prix_ht DOUBLE PRECISION NOT NULL, ADD fiche_tarif_prod LONGTEXT DEFAULT NULL, ADD image1 LONGTEXT DEFAULT NULL, ADD image2 LONGTEXT DEFAULT NULL, ADD image3 LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit DROP description_courte, DROP video1, DROP video2, DROP fiche_descriptive, DROP caracteristiques, DROP prix_ht, DROP fiche_tarif_prod, DROP image1, DROP image2, DROP image3');
    }
}
