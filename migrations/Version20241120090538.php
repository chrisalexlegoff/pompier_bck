<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241120090538 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE loan DROP CONSTRAINT FK_C5D30D03E308AC6F');
        $this->addSql('ALTER TABLE loan DROP CONSTRAINT FK_C5D30D0319EB6921');
        $this->addSql('ALTER TABLE loan ADD is_available BOOLEAN NOT NULL');
        $this->addSql('ALTER TABLE loan ADD CONSTRAINT FK_C5D30D03E308AC6F FOREIGN KEY (material_id) REFERENCES material (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE loan ADD CONSTRAINT FK_C5D30D0319EB6921 FOREIGN KEY (client_id) REFERENCES "user" (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE loan DROP CONSTRAINT fk_c5d30d03e308ac6f');
        $this->addSql('ALTER TABLE loan DROP CONSTRAINT fk_c5d30d0319eb6921');
        $this->addSql('ALTER TABLE loan DROP is_available');
        $this->addSql('ALTER TABLE loan ADD CONSTRAINT fk_c5d30d03e308ac6f FOREIGN KEY (material_id) REFERENCES material (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE loan ADD CONSTRAINT fk_c5d30d0319eb6921 FOREIGN KEY (client_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
