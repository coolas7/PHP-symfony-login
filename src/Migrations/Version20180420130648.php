<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180420130648 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE users CHANGE email email VARCHAR(32) NOT NULL, CHANGE user_type user_type VARCHAR(32) NOT NULL, CHANGE pass pass VARCHAR(32) NOT NULL, CHANGE username username VARCHAR(32) NOT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE users CHANGE email email VARCHAR(191) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE user_type user_type VARCHAR(191) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE username username VARCHAR(191) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE pass pass VARCHAR(191) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
