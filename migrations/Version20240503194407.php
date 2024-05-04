<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240503194407 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire ADD commentaire LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE user DROP commentaire, DROP date_commentaire, DROP date_modification');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP commentaire');
        $this->addSql('ALTER TABLE user ADD commentaire LONGTEXT NOT NULL, ADD date_commentaire DATETIME NOT NULL, ADD date_modification DATETIME NOT NULL');
    }
}
