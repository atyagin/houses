<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190904040738 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE quarters_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE house (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, floors INT NOT NULL, deadline DATETIME NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quarters (id INT AUTO_INCREMENT NOT NULL, house_id INT NOT NULL, type_id INT NOT NULL, number INT NOT NULL, floor INT NOT NULL, rooms INT NOT NULL, square INT NOT NULL, price INT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_8576DB496BB74515 (house_id), INDEX IDX_8576DB49C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE quarters ADD CONSTRAINT FK_8576DB496BB74515 FOREIGN KEY (house_id) REFERENCES house (id)');
        $this->addSql('ALTER TABLE quarters ADD CONSTRAINT FK_8576DB49C54C8C93 FOREIGN KEY (type_id) REFERENCES quarters_type (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE quarters DROP FOREIGN KEY FK_8576DB49C54C8C93');
        $this->addSql('ALTER TABLE quarters DROP FOREIGN KEY FK_8576DB496BB74515');
        $this->addSql('DROP TABLE quarters_type');
        $this->addSql('DROP TABLE house');
        $this->addSql('DROP TABLE quarters');
    }
}
