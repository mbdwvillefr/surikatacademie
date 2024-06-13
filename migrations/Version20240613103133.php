<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240613103133 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE info_user (id INT AUTO_INCREMENT NOT NULL, address VARCHAR(255) NOT NULL, phone VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE question');
        $this->addSql('ALTER TABLE company ADD name VARCHAR(255) NOT NULL, ADD address VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE cours ADD formation_id INT DEFAULT NULL, ADD name VARCHAR(255) NOT NULL, ADD description LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9C5200282E FOREIGN KEY (formation_id) REFERENCES formation (id)');
        $this->addSql('CREATE INDEX IDX_FDCA8C9C5200282E ON cours (formation_id)');
        $this->addSql('ALTER TABLE formation ADD name VARCHAR(255) NOT NULL, ADD description LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE inscription ADD user_id INT DEFAULT NULL, ADD formation_id INT DEFAULT NULL, ADD date DATE NOT NULL');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D65200282E FOREIGN KEY (formation_id) REFERENCES formation (id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D6A76ED395 ON inscription (user_id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D65200282E ON inscription (formation_id)');
        $this->addSql('ALTER TABLE user ADD info_user_id INT DEFAULT NULL, ADD email VARCHAR(255) NOT NULL, ADD password VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64925ABFA0B FOREIGN KEY (info_user_id) REFERENCES info_user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64925ABFA0B ON user (info_user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64925ABFA0B');
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE info_user');
        $this->addSql('ALTER TABLE company DROP name, DROP address');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9C5200282E');
        $this->addSql('DROP INDEX IDX_FDCA8C9C5200282E ON cours');
        $this->addSql('ALTER TABLE cours DROP formation_id, DROP name, DROP description');
        $this->addSql('ALTER TABLE formation DROP name, DROP description');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6A76ED395');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D65200282E');
        $this->addSql('DROP INDEX IDX_5E90F6D6A76ED395 ON inscription');
        $this->addSql('DROP INDEX IDX_5E90F6D65200282E ON inscription');
        $this->addSql('ALTER TABLE inscription DROP user_id, DROP formation_id, DROP date');
        $this->addSql('DROP INDEX UNIQ_8D93D64925ABFA0B ON user');
        $this->addSql('ALTER TABLE user DROP info_user_id, DROP email, DROP password');
    }
}
