<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240503200223 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCEC2AA9D2');
        $this->addSql('DROP INDEX IDX_67F068BCEC2AA9D2 ON commentaire');
        $this->addSql('ALTER TABLE commentaire DROP jeux_id');
        $this->addSql('ALTER TABLE jeux ADD date_sortie DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire ADD jeux_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCEC2AA9D2 FOREIGN KEY (jeux_id) REFERENCES jeux (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_67F068BCEC2AA9D2 ON commentaire (jeux_id)');
        $this->addSql('ALTER TABLE jeux DROP date_sortie');
    }
}
