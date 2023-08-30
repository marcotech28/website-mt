<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230201111532 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utilisation ADD categorie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisation ADD CONSTRAINT FK_B02A3C43BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_B02A3C43BCF5E72D ON utilisation (categorie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utilisation DROP FOREIGN KEY FK_B02A3C43BCF5E72D');
        $this->addSql('DROP INDEX IDX_B02A3C43BCF5E72D ON utilisation');
        $this->addSql('ALTER TABLE utilisation DROP categorie_id');
    }
}
