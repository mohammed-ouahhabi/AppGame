<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240503203126 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE offre (id INT AUTO_INCREMENT NOT NULL, jeux_id INT DEFAULT NULL, coupon_id INT DEFAULT NULL, prix DOUBLE PRECISION NOT NULL, lien VARCHAR(255) NOT NULL, edition VARCHAR(255) NOT NULL, plateforme_jeu VARCHAR(255) NOT NULL, plateforme_activation VARCHAR(255) NOT NULL, INDEX IDX_AF86866FEC2AA9D2 (jeux_id), INDEX IDX_AF86866F66C5951B (coupon_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE offre ADD CONSTRAINT FK_AF86866FEC2AA9D2 FOREIGN KEY (jeux_id) REFERENCES jeux (id)');
        $this->addSql('ALTER TABLE offre ADD CONSTRAINT FK_AF86866F66C5951B FOREIGN KEY (coupon_id) REFERENCES coupon (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre DROP FOREIGN KEY FK_AF86866FEC2AA9D2');
        $this->addSql('ALTER TABLE offre DROP FOREIGN KEY FK_AF86866F66C5951B');
        $this->addSql('DROP TABLE offre');
    }
}
