<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200212094305 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE anuncio (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, titulo VARCHAR(200) NOT NULL, descripcion LONGTEXT NOT NULL, precio NUMERIC(10, 2) NOT NULL, fecha_crea DATETIME NOT NULL, fecha_mod DATETIME NOT NULL, foto_principal VARCHAR(255) NOT NULL, INDEX IDX_4B3BC0D4A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE foto (id INT AUTO_INCREMENT NOT NULL, anuncio_id INT DEFAULT NULL, nombre VARCHAR(200) NOT NULL, INDEX IDX_EADC3BE5963066FD (anuncio_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE provincia (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, provincia_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles VARCHAR(200) DEFAULT NULL, password VARCHAR(255) NOT NULL, nombre VARCHAR(200) NOT NULL, apellidos VARCHAR(200) NOT NULL, telefono VARCHAR(100) NOT NULL, foto VARCHAR(200) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D6494E7121AF (provincia_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE anuncio ADD CONSTRAINT FK_4B3BC0D4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE foto ADD CONSTRAINT FK_EADC3BE5963066FD FOREIGN KEY (anuncio_id) REFERENCES anuncio (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6494E7121AF FOREIGN KEY (provincia_id) REFERENCES provincia (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE foto DROP FOREIGN KEY FK_EADC3BE5963066FD');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6494E7121AF');
        $this->addSql('ALTER TABLE anuncio DROP FOREIGN KEY FK_4B3BC0D4A76ED395');
        $this->addSql('DROP TABLE anuncio');
        $this->addSql('DROP TABLE foto');
        $this->addSql('DROP TABLE provincia');
        $this->addSql('DROP TABLE user');
    }
}
