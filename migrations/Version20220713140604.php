<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220713140604 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE familia (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE familia_juego_de_tronos (familia_id INT NOT NULL, juego_de_tronos_id INT NOT NULL, INDEX IDX_2D84FFD8D02563A3 (familia_id), INDEX IDX_2D84FFD8D9C13688 (juego_de_tronos_id), PRIMARY KEY(familia_id, juego_de_tronos_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE family (id INT AUTO_INCREMENT NOT NULL, families_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_A5E6215B5DFECCD4 (families_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE familia_juego_de_tronos ADD CONSTRAINT FK_2D84FFD8D02563A3 FOREIGN KEY (familia_id) REFERENCES familia (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE familia_juego_de_tronos ADD CONSTRAINT FK_2D84FFD8D9C13688 FOREIGN KEY (juego_de_tronos_id) REFERENCES juego_de_tronos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE family ADD CONSTRAINT FK_A5E6215B5DFECCD4 FOREIGN KEY (families_id) REFERENCES family (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE familia_juego_de_tronos DROP FOREIGN KEY FK_2D84FFD8D02563A3');
        $this->addSql('ALTER TABLE family DROP FOREIGN KEY FK_A5E6215B5DFECCD4');
        $this->addSql('DROP TABLE familia');
        $this->addSql('DROP TABLE familia_juego_de_tronos');
        $this->addSql('DROP TABLE family');
    }
}
