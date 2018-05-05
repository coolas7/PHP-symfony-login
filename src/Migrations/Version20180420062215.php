<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180420062215 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE vartotojai (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE users ADD user_type LONGTEXT NOT NULL, DROP usertype, CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE username username LONGTEXT NOT NULL, CHANGE email email LONGTEXT NOT NULL, CHANGE password password LONGTEXT NOT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE vartotojai');
        $this->addSql('ALTER TABLE users ADD usertype VARCHAR(100) NOT NULL COLLATE utf8_general_ci, DROP user_type, CHANGE id id INT NOT NULL, CHANGE username username VARCHAR(100) NOT NULL COLLATE utf8_general_ci, CHANGE email email VARCHAR(100) NOT NULL COLLATE utf8_general_ci, CHANGE password password VARCHAR(64) NOT NULL COLLATE utf8_general_ci');
    }
}
