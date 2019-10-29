<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191028134748 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commentary ADD post_id INT NOT NULL, ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE commentary ADD CONSTRAINT FK_1CAC12CA4B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('ALTER TABLE commentary ADD CONSTRAINT FK_1CAC12CAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_1CAC12CA4B89032C ON commentary (post_id)');
        $this->addSql('CREATE INDEX IDX_1CAC12CAA76ED395 ON commentary (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commentary DROP FOREIGN KEY FK_1CAC12CA4B89032C');
        $this->addSql('ALTER TABLE commentary DROP FOREIGN KEY FK_1CAC12CAA76ED395');
        $this->addSql('DROP INDEX IDX_1CAC12CA4B89032C ON commentary');
        $this->addSql('DROP INDEX IDX_1CAC12CAA76ED395 ON commentary');
        $this->addSql('ALTER TABLE commentary DROP post_id, DROP user_id');
    }
}
