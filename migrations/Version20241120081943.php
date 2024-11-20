<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241120081943 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE material DROP CONSTRAINT FK_7CBE75953552A536');
        $this->addSql('ALTER TABLE material ADD CONSTRAINT FK_7CBE75953552A536 FOREIGN KEY (mat_category_id) REFERENCES material_cat (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE material_cat DROP CONSTRAINT FK_28645F5E12469DE2');
        $this->addSql('ALTER TABLE material_cat ADD CONSTRAINT FK_28645F5E12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE material DROP CONSTRAINT fk_7cbe75953552a536');
        $this->addSql('ALTER TABLE material ADD CONSTRAINT fk_7cbe75953552a536 FOREIGN KEY (mat_category_id) REFERENCES material_cat (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE material_cat DROP CONSTRAINT fk_28645f5e12469de2');
        $this->addSql('ALTER TABLE material_cat ADD CONSTRAINT fk_28645f5e12469de2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}