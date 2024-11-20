<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241120082450 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP CONSTRAINT FK_D34A04AD84D1E8E7');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD84D1E8E7 FOREIGN KEY (product_cat_id) REFERENCES product_cat (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE product DROP CONSTRAINT fk_d34a04ad84d1e8e7');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT fk_d34a04ad84d1e8e7 FOREIGN KEY (product_cat_id) REFERENCES product_cat (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
