<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240503192422 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE jeux ADD developpeur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE jeux ADD CONSTRAINT FK_3755B50D84E66085 FOREIGN KEY (developpeur_id) REFERENCES developpeur (id)');
        $this->addSql('CREATE INDEX IDX_3755B50D84E66085 ON jeux (developpeur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE jeux DROP FOREIGN KEY FK_3755B50D84E66085');
        $this->addSql('DROP INDEX IDX_3755B50D84E66085 ON jeux');
        $this->addSql('ALTER TABLE jeux DROP developpeur_id');
    }
}
