<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210524145947 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE store_file ADD original_file_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE store_file ADD stored_filename VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE store_file ADD stored_path VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE store_file ADD mime_type VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE store_file ADD added_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE store_file ADD last_access_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE store_file DROP originalfilename');
        $this->addSql('ALTER TABLE store_file DROP storedfilename');
        $this->addSql('ALTER TABLE store_file DROP storedpath');
        $this->addSql('ALTER TABLE store_file DROP mimetype');
        $this->addSql('ALTER TABLE store_file DROP addingdate');
        $this->addSql('ALTER TABLE store_file DROP lastaccesstime');
        $this->addSql('ALTER TABLE store_file DROP file');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE store_file ADD originalfilename VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE store_file ADD storedfilename VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE store_file ADD storedpath VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE store_file ADD mimetype VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE store_file ADD addingdate TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE store_file ADD lastaccesstime TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE store_file ADD file VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE store_file DROP original_file_name');
        $this->addSql('ALTER TABLE store_file DROP stored_filename');
        $this->addSql('ALTER TABLE store_file DROP stored_path');
        $this->addSql('ALTER TABLE store_file DROP mime_type');
        $this->addSql('ALTER TABLE store_file DROP added_date');
        $this->addSql('ALTER TABLE store_file DROP last_access_date');
    }
}
