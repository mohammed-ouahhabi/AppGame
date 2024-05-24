<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240524143324 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, jeux_id INT DEFAULT NULL, commentaire LONGTEXT NOT NULL, date_commentaire DATETIME NOT NULL, date_modification DATETIME NOT NULL, note INT NOT NULL, est_valide TINYINT(1) NOT NULL, INDEX IDX_67F068BCA76ED395 (user_id), INDEX IDX_67F068BCEC2AA9D2 (jeux_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE coupon (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, reduction INT NOT NULL, expiration_date DATETIME DEFAULT NULL, is_active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE developpeur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE editeur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE jeu_platform (id INT AUTO_INCREMENT NOT NULL, jeux_id INT DEFAULT NULL, plateforme VARCHAR(255) NOT NULL, INDEX IDX_79C8B7A5EC2AA9D2 (jeux_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE jeux (id INT AUTO_INCREMENT NOT NULL, developpeur_id INT DEFAULT NULL, editeur_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, date_sortie DATETIME NOT NULL, INDEX IDX_3755B50D84E66085 (developpeur_id), INDEX IDX_3755B50D3375BD21 (editeur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE jeux_plateformes (jeux_id INT NOT NULL, jeu_platform_id INT NOT NULL, INDEX IDX_8A216C33EC2AA9D2 (jeux_id), INDEX IDX_8A216C3387C9283F (jeu_platform_id), PRIMARY KEY(jeux_id, jeu_platform_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offre (id INT AUTO_INCREMENT NOT NULL, jeux_id INT DEFAULT NULL, coupon_id INT DEFAULT NULL, prix NUMERIC(10, 0) NOT NULL, lien VARCHAR(255) NOT NULL, edition VARCHAR(255) NOT NULL, plateforme_jeu VARCHAR(255) NOT NULL, plateforme_activation VARCHAR(255) DEFAULT NULL, INDEX IDX_AF86866FEC2AA9D2 (jeux_id), INDEX IDX_AF86866F66C5951B (coupon_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_wishlist (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, jeux_id INT DEFAULT NULL, est_publique TINYINT(1) NOT NULL, INDEX IDX_7C6CCE31A76ED395 (user_id), INDEX IDX_7C6CCE31EC2AA9D2 (jeux_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCEC2AA9D2 FOREIGN KEY (jeux_id) REFERENCES jeux (id)');
        $this->addSql('ALTER TABLE jeu_platform ADD CONSTRAINT FK_79C8B7A5EC2AA9D2 FOREIGN KEY (jeux_id) REFERENCES jeux (id)');
        $this->addSql('ALTER TABLE jeux ADD CONSTRAINT FK_3755B50D84E66085 FOREIGN KEY (developpeur_id) REFERENCES developpeur (id)');
        $this->addSql('ALTER TABLE jeux ADD CONSTRAINT FK_3755B50D3375BD21 FOREIGN KEY (editeur_id) REFERENCES editeur (id)');
        $this->addSql('ALTER TABLE jeux_plateformes ADD CONSTRAINT FK_8A216C33EC2AA9D2 FOREIGN KEY (jeux_id) REFERENCES jeux (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE jeux_plateformes ADD CONSTRAINT FK_8A216C3387C9283F FOREIGN KEY (jeu_platform_id) REFERENCES jeu_platform (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offre ADD CONSTRAINT FK_AF86866FEC2AA9D2 FOREIGN KEY (jeux_id) REFERENCES jeux (id)');
        $this->addSql('ALTER TABLE offre ADD CONSTRAINT FK_AF86866F66C5951B FOREIGN KEY (coupon_id) REFERENCES coupon (id)');
        $this->addSql('ALTER TABLE user_wishlist ADD CONSTRAINT FK_7C6CCE31A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_wishlist ADD CONSTRAINT FK_7C6CCE31EC2AA9D2 FOREIGN KEY (jeux_id) REFERENCES jeux (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCA76ED395');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCEC2AA9D2');
        $this->addSql('ALTER TABLE jeu_platform DROP FOREIGN KEY FK_79C8B7A5EC2AA9D2');
        $this->addSql('ALTER TABLE jeux DROP FOREIGN KEY FK_3755B50D84E66085');
        $this->addSql('ALTER TABLE jeux DROP FOREIGN KEY FK_3755B50D3375BD21');
        $this->addSql('ALTER TABLE jeux_plateformes DROP FOREIGN KEY FK_8A216C33EC2AA9D2');
        $this->addSql('ALTER TABLE jeux_plateformes DROP FOREIGN KEY FK_8A216C3387C9283F');
        $this->addSql('ALTER TABLE offre DROP FOREIGN KEY FK_AF86866FEC2AA9D2');
        $this->addSql('ALTER TABLE offre DROP FOREIGN KEY FK_AF86866F66C5951B');
        $this->addSql('ALTER TABLE user_wishlist DROP FOREIGN KEY FK_7C6CCE31A76ED395');
        $this->addSql('ALTER TABLE user_wishlist DROP FOREIGN KEY FK_7C6CCE31EC2AA9D2');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE coupon');
        $this->addSql('DROP TABLE developpeur');
        $this->addSql('DROP TABLE editeur');
        $this->addSql('DROP TABLE jeu_platform');
        $this->addSql('DROP TABLE jeux');
        $this->addSql('DROP TABLE jeux_plateformes');
        $this->addSql('DROP TABLE offre');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_wishlist');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
