<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240620125614 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64912469DE2');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64925ABFA0B');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649979B1AD6');
        $this->addSql('DROP INDEX UNIQ_8D93D64925ABFA0B ON user');
        $this->addSql('DROP INDEX IDX_8D93D649979B1AD6 ON user');
        $this->addSql('DROP INDEX IDX_8D93D64912469DE2 ON user');
        $this->addSql('ALTER TABLE user ADD roles JSON NOT NULL, ADD address VARCHAR(255) DEFAULT NULL, ADD phone VARCHAR(20) DEFAULT NULL, DROP category_id, DROP info_user_id, CHANGE name name VARCHAR(255) DEFAULT NULL, CHANGE email email VARCHAR(180) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('ALTER TABLE user ADD category_id INT NOT NULL, ADD info_user_id INT NOT NULL, DROP roles, DROP address, DROP phone, CHANGE email email VARCHAR(255) NOT NULL, CHANGE name name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64912469DE2 FOREIGN KEY (category_id) REFERENCES user_category (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64925ABFA0B FOREIGN KEY (info_user_id) REFERENCES info_user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64925ABFA0B ON user (info_user_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649979B1AD6 ON user (company_id)');
        $this->addSql('CREATE INDEX IDX_8D93D64912469DE2 ON user (category_id)');
    }
}
