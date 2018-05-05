<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180420063640 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE vartotojai (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tasks CHANGE status status2 LONGTEXT NOT NULL');
        $this->addSql('DROP INDEX UNIQ_1483A5E9F85E0677 ON users');
        $this->addSql('DROP INDEX UNIQ_1483A5E9E7927C74 ON users');
        $this->addSql('ALTER TABLE users CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE username username LONGTEXT NOT NULL, CHANGE email email LONGTEXT NOT NULL, CHANGE user_type user_type LONGTEXT NOT NULL, CHANGE pass pass LONGTEXT NOT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE vartotojai');
        $this->addSql('ALTER TABLE tasks CHANGE status2 status LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE users CHANGE id id INT NOT NULL, CHANGE username username VARCHAR(20) NOT NULL COLLATE utf8_general_ci, CHANGE email email VARCHAR(200) NOT NULL COLLATE utf8_general_ci, CHANGE user_type user_type VARCHAR(255) NOT NULL COLLATE utf8_general_ci, CHANGE pass pass VARCHAR(64) NOT NULL COLLATE utf8_general_ci');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9F85E0677 ON users (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9E7927C74 ON users (email)');
    }
}
