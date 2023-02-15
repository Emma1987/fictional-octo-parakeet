<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230214231513 extends AbstractMigration
{
	public function getDescription(): string
	{
		return '';
	}

	public function up(Schema $schema): void
	{
		// this up() migration is auto-generated, please modify it to your needs
		$this->addSql('CREATE TABLE review (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, website_id INT DEFAULT NULL, comment VARCHAR(255) NOT NULL, INDEX IDX_794381C6A76ED395 (user_id), INDEX IDX_794381C618F45C82 (website_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
		$this->addSql('CREATE TABLE website (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_476F5DE7F47645AE (url), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
		$this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6A76ED395 FOREIGN KEY (user_id) REFERENCES eckinox_users (id)');
		$this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C618F45C82 FOREIGN KEY (website_id) REFERENCES website (id)');
		$this->addSql('CREATE UNIQUE INDEX UNIQ_661897509BE8FD98 ON eckinox_app_users (facebook_id)');
	}

	public function down(Schema $schema): void
	{
		// this down() migration is auto-generated, please modify it to your needs
		$this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C6A76ED395');
		$this->addSql('ALTER TABLE review DROP FOREIGN KEY FK_794381C618F45C82');
		$this->addSql('DROP TABLE review');
		$this->addSql('DROP TABLE website');
		$this->addSql('DROP INDEX UNIQ_661897509BE8FD98 ON eckinox_app_users');
	}
}
