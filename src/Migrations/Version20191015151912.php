<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191015151912 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user ADD mail VARCHAR(180) NOT NULL, ADD reset_token VARCHAR(180)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D6495126AC48 ON user (mail)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649D7C8DC19 ON user (reset_token)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql',
            'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX UNIQ_8D93D6495126AC48 ON user');
        $this->addSql('DROP INDEX UNIQ_8D93D649D7C8DC19 ON user');
        $this->addSql('ALTER TABLE user DROP mail, DROP reset_token');
    }
}
