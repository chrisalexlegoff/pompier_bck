<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241120184731 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id SERIAL NOT NULL, name VARCHAR(25) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE command (id SERIAL NOT NULL, client_id INT DEFAULT NULL, status BOOLEAN NOT NULL, total_price DOUBLE PRECISION NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8ECAEAD419EB6921 ON command (client_id)');
        $this->addSql('CREATE TABLE loan (id SERIAL NOT NULL, material_id INT DEFAULT NULL, client_id INT DEFAULT NULL, loan_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, return_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C5D30D03E308AC6F ON loan (material_id)');
        $this->addSql('CREATE INDEX IDX_C5D30D0319EB6921 ON loan (client_id)');
        $this->addSql('COMMENT ON COLUMN loan.loan_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN loan.return_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE material (id SERIAL NOT NULL, mat_category_id INT DEFAULT NULL, stock_id INT DEFAULT NULL, name VARCHAR(25) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7CBE75953552A536 ON material (mat_category_id)');
        $this->addSql('CREATE INDEX IDX_7CBE7595DCD6110 ON material (stock_id)');
        $this->addSql('CREATE TABLE material_cat (id SERIAL NOT NULL, category_id INT DEFAULT NULL, name VARCHAR(25) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_28645F5E12469DE2 ON material_cat (category_id)');
        $this->addSql('CREATE TABLE matricule (id SERIAL NOT NULL, matricule VARCHAR(25) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_12B2DC9C12B2DC9C ON matricule (matricule)');
        $this->addSql('CREATE TABLE product (id SERIAL NOT NULL, product_cat_id INT DEFAULT NULL, stock_id INT DEFAULT NULL, name VARCHAR(25) NOT NULL, unitary_price DOUBLE PRECISION NOT NULL, image_name VARCHAR(255) DEFAULT NULL, image_size INT DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D34A04AD84D1E8E7 ON product (product_cat_id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADDCD6110 ON product (stock_id)');
        $this->addSql('COMMENT ON COLUMN product.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE product_command (product_id INT NOT NULL, command_id INT NOT NULL, PRIMARY KEY(product_id, command_id))');
        $this->addSql('CREATE INDEX IDX_5F13F1644584665A ON product_command (product_id)');
        $this->addSql('CREATE INDEX IDX_5F13F16433E1689A ON product_command (command_id)');
        $this->addSql('CREATE TABLE product_cat (id SERIAL NOT NULL, category_id INT DEFAULT NULL, name VARCHAR(25) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7E7117B712469DE2 ON product_cat (category_id)');
        $this->addSql('CREATE TABLE stock (id SERIAL NOT NULL, quantity INT NOT NULL, name VARCHAR(25) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "user" (id SERIAL NOT NULL, matricule_id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, is_verified BOOLEAN NOT NULL, identifiant VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8D93D6499AAADC05 ON "user" (matricule_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON "user" (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER ON "user" (identifiant)');
        $this->addSql('ALTER TABLE command ADD CONSTRAINT FK_8ECAEAD419EB6921 FOREIGN KEY (client_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE loan ADD CONSTRAINT FK_C5D30D03E308AC6F FOREIGN KEY (material_id) REFERENCES material (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE loan ADD CONSTRAINT FK_C5D30D0319EB6921 FOREIGN KEY (client_id) REFERENCES "user" (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE material ADD CONSTRAINT FK_7CBE75953552A536 FOREIGN KEY (mat_category_id) REFERENCES material_cat (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE material ADD CONSTRAINT FK_7CBE7595DCD6110 FOREIGN KEY (stock_id) REFERENCES stock (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE material_cat ADD CONSTRAINT FK_28645F5E12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD84D1E8E7 FOREIGN KEY (product_cat_id) REFERENCES product_cat (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADDCD6110 FOREIGN KEY (stock_id) REFERENCES stock (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_command ADD CONSTRAINT FK_5F13F1644584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_command ADD CONSTRAINT FK_5F13F16433E1689A FOREIGN KEY (command_id) REFERENCES command (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_cat ADD CONSTRAINT FK_7E7117B712469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D6499AAADC05 FOREIGN KEY (matricule_id) REFERENCES matricule (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE command DROP CONSTRAINT FK_8ECAEAD419EB6921');
        $this->addSql('ALTER TABLE loan DROP CONSTRAINT FK_C5D30D03E308AC6F');
        $this->addSql('ALTER TABLE loan DROP CONSTRAINT FK_C5D30D0319EB6921');
        $this->addSql('ALTER TABLE material DROP CONSTRAINT FK_7CBE75953552A536');
        $this->addSql('ALTER TABLE material DROP CONSTRAINT FK_7CBE7595DCD6110');
        $this->addSql('ALTER TABLE material_cat DROP CONSTRAINT FK_28645F5E12469DE2');
        $this->addSql('ALTER TABLE product DROP CONSTRAINT FK_D34A04AD84D1E8E7');
        $this->addSql('ALTER TABLE product DROP CONSTRAINT FK_D34A04ADDCD6110');
        $this->addSql('ALTER TABLE product_command DROP CONSTRAINT FK_5F13F1644584665A');
        $this->addSql('ALTER TABLE product_command DROP CONSTRAINT FK_5F13F16433E1689A');
        $this->addSql('ALTER TABLE product_cat DROP CONSTRAINT FK_7E7117B712469DE2');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D6499AAADC05');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE command');
        $this->addSql('DROP TABLE loan');
        $this->addSql('DROP TABLE material');
        $this->addSql('DROP TABLE material_cat');
        $this->addSql('DROP TABLE matricule');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_command');
        $this->addSql('DROP TABLE product_cat');
        $this->addSql('DROP TABLE stock');
        $this->addSql('DROP TABLE "user"');
    }
}
