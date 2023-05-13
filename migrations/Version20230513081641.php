<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230513081641 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE envio ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE envio ADD CONSTRAINT FK_754737D5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_754737D5A76ED395 ON envio (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE envio DROP FOREIGN KEY FK_754737D5A76ED395');
        $this->addSql('DROP INDEX IDX_754737D5A76ED395 ON envio');
        $this->addSql('ALTER TABLE envio DROP user_id');
    }
}
