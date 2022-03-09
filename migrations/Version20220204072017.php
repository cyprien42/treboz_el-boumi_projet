<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220204072017 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE acces (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, autorisation_id INT NOT NULL, document_id INT NOT NULL, INDEX IDX_D0F43B10FB88E14F (utilisateur_id), INDEX IDX_D0F43B1052C5E836 (autorisation_id), INDEX IDX_D0F43B10C33F7837 (document_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE acces ADD CONSTRAINT FK_D0F43B10FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE acces ADD CONSTRAINT FK_D0F43B1052C5E836 FOREIGN KEY (autorisation_id) REFERENCES autorisation (id)');
        $this->addSql('ALTER TABLE acces ADD CONSTRAINT FK_D0F43B10C33F7837 FOREIGN KEY (document_id) REFERENCES document (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE acces');
    }
}
