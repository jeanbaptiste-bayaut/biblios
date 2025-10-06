<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251002144546 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE author_book (author_id INT NOT NULL, book_id INT NOT NULL, PRIMARY KEY(author_id, book_id))');
        $this->addSql('CREATE INDEX IDX_2F0A2BEEF675F31B ON author_book (author_id)');
        $this->addSql('CREATE INDEX IDX_2F0A2BEE16A2B381 ON author_book (book_id)');
        $this->addSql('ALTER TABLE author_book ADD CONSTRAINT FK_2F0A2BEEF675F31B FOREIGN KEY (author_id) REFERENCES author (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE author_book ADD CONSTRAINT FK_2F0A2BEE16A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE book DROP CONSTRAINT fk_cbe5a3316de2013a');
        $this->addSql('DROP INDEX idx_cbe5a3316de2013a');
        $this->addSql('ALTER TABLE book ADD cover VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE book DROP authors_id');
        $this->addSql('ALTER TABLE book ALTER edited_at TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE book ALTER plot TYPE TEXT');
        $this->addSql('COMMENT ON COLUMN book.edited_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE comment ALTER book_id SET NOT NULL');
        $this->addSql('ALTER TABLE comment RENAME COLUMN published TO published_at');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE author_book DROP CONSTRAINT FK_2F0A2BEEF675F31B');
        $this->addSql('ALTER TABLE author_book DROP CONSTRAINT FK_2F0A2BEE16A2B381');
        $this->addSql('DROP TABLE author_book');
        $this->addSql('ALTER TABLE comment ALTER book_id DROP NOT NULL');
        $this->addSql('ALTER TABLE comment RENAME COLUMN published_at TO published');
        $this->addSql('ALTER TABLE book ADD authors_id INT NOT NULL');
        $this->addSql('ALTER TABLE book DROP cover');
        $this->addSql('ALTER TABLE book ALTER edited_at TYPE DATE');
        $this->addSql('ALTER TABLE book ALTER plot TYPE VARCHAR(255)');
        $this->addSql('COMMENT ON COLUMN book.edited_at IS NULL');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT fk_cbe5a3316de2013a FOREIGN KEY (authors_id) REFERENCES author (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_cbe5a3316de2013a ON book (authors_id)');
    }
}
