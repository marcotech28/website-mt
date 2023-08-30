<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230802074509 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE produit_produit (produit_source INT NOT NULL, produit_target INT NOT NULL, INDEX IDX_EF5E675EA8D8B449 (produit_source), INDEX IDX_EF5E675EB13DE4C6 (produit_target), PRIMARY KEY(produit_source, produit_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE produit_produit ADD CONSTRAINT FK_EF5E675EA8D8B449 FOREIGN KEY (produit_source) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit_produit ADD CONSTRAINT FK_EF5E675EB13DE4C6 FOREIGN KEY (produit_target) REFERENCES produit (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produit_produit DROP FOREIGN KEY FK_EF5E675EA8D8B449');
        $this->addSql('ALTER TABLE produit_produit DROP FOREIGN KEY FK_EF5E675EB13DE4C6');
        $this->addSql('DROP TABLE produit_produit');
    }
}
