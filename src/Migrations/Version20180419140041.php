<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180419140041 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE users ADD username LONGTEXT NOT NULL, CHANGE id id INT NOT NULL, CHANGE email email LONGTEXT NOT NULL, CHANGE user_type user_type LONGTEXT NOT NULL, CHANGE pass pass LONGTEXT NOT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE users DROP username, CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE email email VARCHAR(200) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE user_type user_type VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE pass pass VARCHAR(64) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
