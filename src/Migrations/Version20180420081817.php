<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180420081817 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_1483A5E9F85E0677 ON users');
        $this->addSql('ALTER TABLE users CHANGE username username TEXT NOT NULL, CHANGE email email LONGTEXT NOT NULL, CHANGE user_type user_type LONGTEXT NOT NULL, CHANGE pass pass LONGTEXT NOT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE users CHANGE username username VARCHAR(20) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE email email VARCHAR(200) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE user_type user_type VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE pass pass VARCHAR(64) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('CREATE INDEX UNIQ_1483A5E9F85E0677 ON users (username)');
    }
}
