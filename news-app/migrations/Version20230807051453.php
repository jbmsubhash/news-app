<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230807051453 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE news (id INT AUTO_INCREMENT NOT NULL, news_id VARCHAR(255) NOT NULL, web_publication_date DATETIME NOT NULL COMMENT \'(DC2Type:datetimetz_immutable)\', web_title VARCHAR(255) DEFAULT NULL, web_url VARCHAR(255) DEFAULT NULL, INDEX news_id_idx (news_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_bookmark (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, news_id INT NOT NULL, INDEX IDX_3AEF761DA76ED395 (user_id), INDEX IDX_3AEF761DB5A459A0 (news_id), UNIQUE INDEX unique_userid_news_id_idx (user_id, news_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_bookmark ADD CONSTRAINT FK_3AEF761DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_bookmark ADD CONSTRAINT FK_3AEF761DB5A459A0 FOREIGN KEY (news_id) REFERENCES news (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_bookmark DROP FOREIGN KEY FK_3AEF761DA76ED395');
        $this->addSql('ALTER TABLE user_bookmark DROP FOREIGN KEY FK_3AEF761DB5A459A0');
        $this->addSql('DROP TABLE news');
        $this->addSql('DROP TABLE user_bookmark');
    }
}
