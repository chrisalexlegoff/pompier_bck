<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241120080439 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP CONSTRAINT FK_D34A04ADDCD6110');
        $this->addSql('ALTER TABLE product ALTER stock_id SET NOT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADDCD6110 FOREIGN KEY (stock_id) REFERENCES stock (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE product DROP CONSTRAINT fk_d34a04addcd6110');
        $this->addSql('ALTER TABLE product ALTER stock_id DROP NOT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT fk_d34a04addcd6110 FOREIGN KEY (stock_id) REFERENCES stock (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
