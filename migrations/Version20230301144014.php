<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230301144014 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE additional_information (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, weight DOUBLE PRECISION NOT NULL, size DOUBLE PRECISION NOT NULL, created_at DATE NOT NULL, INDEX IDX_19D9524DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE food (id INT AUTO_INCREMENT NOT NULL, default_grams INT NOT NULL, name VARCHAR(255) NOT NULL, calorie INT NOT NULL, water_intake DOUBLE PRECISION NOT NULL, fiber DOUBLE PRECISION NOT NULL, protein DOUBLE PRECISION NOT NULL, carbohydrate DOUBLE PRECISION NOT NULL, lipid DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE glucose_goal (id INT AUTO_INCREMENT NOT NULL, glucose_min DOUBLE PRECISION NOT NULL, glucose_max DOUBLE PRECISION NOT NULL, glucose_min_f DOUBLE PRECISION NOT NULL, glucose_max_f DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meal (id INT AUTO_INCREMENT NOT NULL, meal_type_id INT DEFAULT NULL, user_id INT DEFAULT NULL, created_at DATE NOT NULL, note LONGTEXT NOT NULL, INDEX IDX_9EF68E9CBCFF3E8A (meal_type_id), INDEX IDX_9EF68E9CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meal_food (id INT AUTO_INCREMENT NOT NULL, food_id INT DEFAULT NULL, meal_id INT DEFAULT NULL, quantity INT NOT NULL, INDEX IDX_CEE6FA03BA8E87C4 (food_id), INDEX IDX_CEE6FA03639666D6 (meal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meal_goal_day (id INT AUTO_INCREMENT NOT NULL, water_intake DOUBLE PRECISION NOT NULL, water DOUBLE PRECISION NOT NULL, number_meals INT NOT NULL, calorie INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meal_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE water (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, quantity DOUBLE PRECISION NOT NULL, created_at DATE NOT NULL, INDEX IDX_FB3314DAA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE additional_information ADD CONSTRAINT FK_19D9524DA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE meal ADD CONSTRAINT FK_9EF68E9CBCFF3E8A FOREIGN KEY (meal_type_id) REFERENCES meal_type (id)');
        $this->addSql('ALTER TABLE meal ADD CONSTRAINT FK_9EF68E9CA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE meal_food ADD CONSTRAINT FK_CEE6FA03BA8E87C4 FOREIGN KEY (food_id) REFERENCES food (id)');
        $this->addSql('ALTER TABLE meal_food ADD CONSTRAINT FK_CEE6FA03639666D6 FOREIGN KEY (meal_id) REFERENCES meal (id)');
        $this->addSql('ALTER TABLE water ADD CONSTRAINT FK_FB3314DAA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE alimentation DROP FOREIGN KEY FK_8E65DFA0D0DC4D56');
        $this->addSql('ALTER TABLE alimentation_nutriment DROP FOREIGN KEY FK_18E953EF3297A3E0');
        $this->addSql('ALTER TABLE alimentation_nutriment DROP FOREIGN KEY FK_18E953EF8441D4D9');
        $this->addSql('ALTER TABLE objectif_alimentation_nutriment DROP FOREIGN KEY FK_653648BE3297A3E0');
        $this->addSql('ALTER TABLE objectif_alimentation_nutriment DROP FOREIGN KEY FK_653648BE869CEB37');
        $this->addSql('DROP TABLE alimentation');
        $this->addSql('DROP TABLE objectif_glucose');
        $this->addSql('DROP TABLE alimentation_nutriment');
        $this->addSql('DROP TABLE objectif_alimentation');
        $this->addSql('DROP TABLE objectif_alimentation_nutriment');
        $this->addSql('DROP TABLE nutriment');
        $this->addSql('DROP TABLE refresh_tokens');
        $this->addSql('DROP TABLE type_repas');
        $this->addSql('ALTER TABLE glucose ADD user_id INT DEFAULT NULL, ADD created_at DATETIME NOT NULL, DROP horaire, CHANGE taux rate DOUBLE PRECISION NOT NULL, CHANGE ajeun is_fasting TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE glucose ADD CONSTRAINT FK_CEAB6699A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_CEAB6699A76ED395 ON glucose (user_id)');
        $this->addSql('ALTER TABLE user ADD meal_goal_day_id INT DEFAULT NULL, ADD glucose_goal_id INT DEFAULT NULL, ADD birthdate DATE NOT NULL, ADD firstname VARCHAR(255) NOT NULL, ADD lastname VARCHAR(255) NOT NULL, ADD created_at DATETIME NOT NULL, ADD acces_at DATETIME NOT NULL, ADD is_active TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6499EBF32EA FOREIGN KEY (meal_goal_day_id) REFERENCES meal_goal_day (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649EF629A11 FOREIGN KEY (glucose_goal_id) REFERENCES glucose_goal (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6499EBF32EA ON user (meal_goal_day_id)');
        $this->addSql('CREATE INDEX IDX_8D93D649EF629A11 ON user (glucose_goal_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649EF629A11');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D6499EBF32EA');
        $this->addSql('CREATE TABLE alimentation (id INT AUTO_INCREMENT NOT NULL, type_repas_id INT DEFAULT NULL, kcal INT NOT NULL, eau DOUBLE PRECISION NOT NULL, date DATE NOT NULL, INDEX IDX_8E65DFA0D0DC4D56 (type_repas_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE objectif_glucose (id INT AUTO_INCREMENT NOT NULL, glycemiemin DOUBLE PRECISION NOT NULL, glycemiemax DOUBLE PRECISION NOT NULL, glycemiemaxa DOUBLE PRECISION NOT NULL, glycemiemina DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE alimentation_nutriment (alimentation_id INT NOT NULL, nutriment_id INT NOT NULL, INDEX IDX_18E953EF8441D4D9 (alimentation_id), INDEX IDX_18E953EF3297A3E0 (nutriment_id), PRIMARY KEY(alimentation_id, nutriment_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE objectif_alimentation (id INT AUTO_INCREMENT NOT NULL, kcaltotal INT NOT NULL, apporteau DOUBLE PRECISION NOT NULL, nbrepas INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE objectif_alimentation_nutriment (objectif_alimentation_id INT NOT NULL, nutriment_id INT NOT NULL, INDEX IDX_653648BE869CEB37 (objectif_alimentation_id), INDEX IDX_653648BE3297A3E0 (nutriment_id), PRIMARY KEY(objectif_alimentation_id, nutriment_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE nutriment (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, grammage DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE refresh_tokens (id INT AUTO_INCREMENT NOT NULL, refresh_token VARCHAR(128) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, username VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, valid DATETIME NOT NULL, UNIQUE INDEX UNIQ_9BACE7E1C74F2195 (refresh_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE type_repas (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE alimentation ADD CONSTRAINT FK_8E65DFA0D0DC4D56 FOREIGN KEY (type_repas_id) REFERENCES type_repas (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE alimentation_nutriment ADD CONSTRAINT FK_18E953EF3297A3E0 FOREIGN KEY (nutriment_id) REFERENCES nutriment (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE alimentation_nutriment ADD CONSTRAINT FK_18E953EF8441D4D9 FOREIGN KEY (alimentation_id) REFERENCES alimentation (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE objectif_alimentation_nutriment ADD CONSTRAINT FK_653648BE3297A3E0 FOREIGN KEY (nutriment_id) REFERENCES nutriment (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE objectif_alimentation_nutriment ADD CONSTRAINT FK_653648BE869CEB37 FOREIGN KEY (objectif_alimentation_id) REFERENCES objectif_alimentation (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE additional_information DROP FOREIGN KEY FK_19D9524DA76ED395');
        $this->addSql('ALTER TABLE meal DROP FOREIGN KEY FK_9EF68E9CBCFF3E8A');
        $this->addSql('ALTER TABLE meal DROP FOREIGN KEY FK_9EF68E9CA76ED395');
        $this->addSql('ALTER TABLE meal_food DROP FOREIGN KEY FK_CEE6FA03BA8E87C4');
        $this->addSql('ALTER TABLE meal_food DROP FOREIGN KEY FK_CEE6FA03639666D6');
        $this->addSql('ALTER TABLE water DROP FOREIGN KEY FK_FB3314DAA76ED395');
        $this->addSql('DROP TABLE additional_information');
        $this->addSql('DROP TABLE food');
        $this->addSql('DROP TABLE glucose_goal');
        $this->addSql('DROP TABLE meal');
        $this->addSql('DROP TABLE meal_food');
        $this->addSql('DROP TABLE meal_goal_day');
        $this->addSql('DROP TABLE meal_type');
        $this->addSql('DROP TABLE water');
        $this->addSql('ALTER TABLE glucose DROP FOREIGN KEY FK_CEAB6699A76ED395');
        $this->addSql('DROP INDEX IDX_CEAB6699A76ED395 ON glucose');
        $this->addSql('ALTER TABLE glucose ADD horaire DATE NOT NULL, DROP user_id, DROP created_at, CHANGE rate taux DOUBLE PRECISION NOT NULL, CHANGE is_fasting ajeun TINYINT(1) NOT NULL');
        $this->addSql('DROP INDEX IDX_8D93D6499EBF32EA ON `user`');
        $this->addSql('DROP INDEX IDX_8D93D649EF629A11 ON `user`');
        $this->addSql('ALTER TABLE `user` DROP meal_goal_day_id, DROP glucose_goal_id, DROP birthdate, DROP firstname, DROP lastname, DROP created_at, DROP acces_at, DROP is_active');
    }
}
