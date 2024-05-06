<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240506150134 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE jeux_plateformes (jeux_id INT NOT NULL, jeu_platforme_id INT NOT NULL, INDEX IDX_8A216C33EC2AA9D2 (jeux_id), INDEX IDX_8A216C3324E25173 (jeu_platforme_id), PRIMARY KEY(jeux_id, jeu_platforme_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE jeux_plateformes ADD CONSTRAINT FK_8A216C33EC2AA9D2 FOREIGN KEY (jeux_id) REFERENCES jeux (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE jeux_plateformes ADD CONSTRAINT FK_8A216C3324E25173 FOREIGN KEY (jeu_platforme_id) REFERENCES jeu_platforme (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE jeux_plateformes DROP FOREIGN KEY FK_8A216C33EC2AA9D2');
        $this->addSql('ALTER TABLE jeux_plateformes DROP FOREIGN KEY FK_8A216C3324E25173');
        $this->addSql('DROP TABLE jeux_plateformes');
    }
}
