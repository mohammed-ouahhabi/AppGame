<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240503194205 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire ADD developpeur_id INT DEFAULT NULL, ADD editeur_id INT DEFAULT NULL, ADD datesortie DATETIME NOT NULL');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC84E66085 FOREIGN KEY (developpeur_id) REFERENCES developpeur (id)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC3375BD21 FOREIGN KEY (editeur_id) REFERENCES editeur (id)');
        $this->addSql('CREATE INDEX IDX_67F068BC84E66085 ON commentaire (developpeur_id)');
        $this->addSql('CREATE INDEX IDX_67F068BC3375BD21 ON commentaire (editeur_id)');
        $this->addSql('ALTER TABLE jeux DROP FOREIGN KEY FK_3755B50D3375BD21');
        $this->addSql('ALTER TABLE jeux DROP FOREIGN KEY FK_3755B50D84E66085');
        $this->addSql('DROP INDEX IDX_3755B50D84E66085 ON jeux');
        $this->addSql('DROP INDEX IDX_3755B50D3375BD21 ON jeux');
        $this->addSql('ALTER TABLE jeux DROP developpeur_id, DROP editeur_id, DROP datesortie');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC84E66085');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC3375BD21');
        $this->addSql('DROP INDEX IDX_67F068BC84E66085 ON commentaire');
        $this->addSql('DROP INDEX IDX_67F068BC3375BD21 ON commentaire');
        $this->addSql('ALTER TABLE commentaire DROP developpeur_id, DROP editeur_id, DROP datesortie');
        $this->addSql('ALTER TABLE jeux ADD developpeur_id INT DEFAULT NULL, ADD editeur_id INT DEFAULT NULL, ADD datesortie DATETIME NOT NULL');
        $this->addSql('ALTER TABLE jeux ADD CONSTRAINT FK_3755B50D3375BD21 FOREIGN KEY (editeur_id) REFERENCES editeur (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE jeux ADD CONSTRAINT FK_3755B50D84E66085 FOREIGN KEY (developpeur_id) REFERENCES developpeur (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_3755B50D84E66085 ON jeux (developpeur_id)');
        $this->addSql('CREATE INDEX IDX_3755B50D3375BD21 ON jeux (editeur_id)');
    }
}
