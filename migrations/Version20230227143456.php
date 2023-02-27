<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230227143456 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE alimentation (id INT AUTO_INCREMENT NOT NULL, type_repas_id INT DEFAULT NULL, kcal INT NOT NULL, eau DOUBLE PRECISION NOT NULL, date DATE NOT NULL, INDEX IDX_8E65DFA0D0DC4D56 (type_repas_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE alimentation_nutriment (alimentation_id INT NOT NULL, nutriment_id INT NOT NULL, INDEX IDX_18E953EF8441D4D9 (alimentation_id), INDEX IDX_18E953EF3297A3E0 (nutriment_id), PRIMARY KEY(alimentation_id, nutriment_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE glucose (id INT AUTO_INCREMENT NOT NULL, taux DOUBLE PRECISION NOT NULL, horaire DATE NOT NULL, ajeun TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nutriment (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, grammage DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE objectif_alimentation (id INT AUTO_INCREMENT NOT NULL, kcaltotal INT NOT NULL, apporteau DOUBLE PRECISION NOT NULL, nbrepas INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE objectif_alimentation_nutriment (objectif_alimentation_id INT NOT NULL, nutriment_id INT NOT NULL, INDEX IDX_653648BE869CEB37 (objectif_alimentation_id), INDEX IDX_653648BE3297A3E0 (nutriment_id), PRIMARY KEY(objectif_alimentation_id, nutriment_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE objectif_glucose (id INT AUTO_INCREMENT NOT NULL, glycemiemin DOUBLE PRECISION NOT NULL, glycemiemax DOUBLE PRECISION NOT NULL, glycemiemaxa DOUBLE PRECISION NOT NULL, glycemiemina DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_repas (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE alimentation ADD CONSTRAINT FK_8E65DFA0D0DC4D56 FOREIGN KEY (type_repas_id) REFERENCES type_repas (id)');
        $this->addSql('ALTER TABLE alimentation_nutriment ADD CONSTRAINT FK_18E953EF8441D4D9 FOREIGN KEY (alimentation_id) REFERENCES alimentation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE alimentation_nutriment ADD CONSTRAINT FK_18E953EF3297A3E0 FOREIGN KEY (nutriment_id) REFERENCES nutriment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE objectif_alimentation_nutriment ADD CONSTRAINT FK_653648BE869CEB37 FOREIGN KEY (objectif_alimentation_id) REFERENCES objectif_alimentation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE objectif_alimentation_nutriment ADD CONSTRAINT FK_653648BE3297A3E0 FOREIGN KEY (nutriment_id) REFERENCES nutriment (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alimentation DROP FOREIGN KEY FK_8E65DFA0D0DC4D56');
        $this->addSql('ALTER TABLE alimentation_nutriment DROP FOREIGN KEY FK_18E953EF8441D4D9');
        $this->addSql('ALTER TABLE alimentation_nutriment DROP FOREIGN KEY FK_18E953EF3297A3E0');
        $this->addSql('ALTER TABLE objectif_alimentation_nutriment DROP FOREIGN KEY FK_653648BE869CEB37');
        $this->addSql('ALTER TABLE objectif_alimentation_nutriment DROP FOREIGN KEY FK_653648BE3297A3E0');
        $this->addSql('DROP TABLE alimentation');
        $this->addSql('DROP TABLE alimentation_nutriment');
        $this->addSql('DROP TABLE glucose');
        $this->addSql('DROP TABLE nutriment');
        $this->addSql('DROP TABLE objectif_alimentation');
        $this->addSql('DROP TABLE objectif_alimentation_nutriment');
        $this->addSql('DROP TABLE objectif_glucose');
        $this->addSql('DROP TABLE type_repas');
    }
}
