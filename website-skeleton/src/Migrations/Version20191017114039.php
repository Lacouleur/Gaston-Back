<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191017114039 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE post ADD user_id INT NOT NULL, ADD post_status_id INT NOT NULL, ADD visibility_id INT NOT NULL, ADD wear_condition_id INT NOT NULL, ADD category_id INT NOT NULL');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DCA997E4A FOREIGN KEY (post_status_id) REFERENCES post_status (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DB7157780 FOREIGN KEY (visibility_id) REFERENCES visibility (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DE34D4D6A FOREIGN KEY (wear_condition_id) REFERENCES `condition` (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_5A8A6C8DA76ED395 ON post (user_id)');
        $this->addSql('CREATE INDEX IDX_5A8A6C8DCA997E4A ON post (post_status_id)');
        $this->addSql('CREATE INDEX IDX_5A8A6C8DB7157780 ON post (visibility_id)');
        $this->addSql('CREATE INDEX IDX_5A8A6C8DE34D4D6A ON post (wear_condition_id)');
        $this->addSql('CREATE INDEX IDX_5A8A6C8D12469DE2 ON post (category_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DA76ED395');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DCA997E4A');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DB7157780');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DE34D4D6A');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D12469DE2');
        $this->addSql('DROP INDEX IDX_5A8A6C8DA76ED395 ON post');
        $this->addSql('DROP INDEX IDX_5A8A6C8DCA997E4A ON post');
        $this->addSql('DROP INDEX IDX_5A8A6C8DB7157780 ON post');
        $this->addSql('DROP INDEX IDX_5A8A6C8DE34D4D6A ON post');
        $this->addSql('DROP INDEX IDX_5A8A6C8D12469DE2 ON post');
        $this->addSql('ALTER TABLE post DROP user_id, DROP post_status_id, DROP visibility_id, DROP wear_condition_id, DROP category_id');
    }
}
