<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230301171841 extends AbstractMigration
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
        $this->addSql('CREATE TABLE glucose (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, rate DOUBLE PRECISION NOT NULL, created_at DATETIME NOT NULL, is_fasting TINYINT(1) NOT NULL, INDEX IDX_CEAB6699A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE glucose_goal (id INT AUTO_INCREMENT NOT NULL, glucose_min DOUBLE PRECISION NOT NULL, glucose_max DOUBLE PRECISION NOT NULL, glucose_min_f DOUBLE PRECISION NOT NULL, glucose_max_f DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meal (id INT AUTO_INCREMENT NOT NULL, meal_type_id INT DEFAULT NULL, user_id INT DEFAULT NULL, created_at DATE NOT NULL, note LONGTEXT NOT NULL, INDEX IDX_9EF68E9CBCFF3E8A (meal_type_id), INDEX IDX_9EF68E9CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meal_food (id INT AUTO_INCREMENT NOT NULL, food_id INT DEFAULT NULL, meal_id INT DEFAULT NULL, quantity INT NOT NULL, INDEX IDX_CEE6FA03BA8E87C4 (food_id), INDEX IDX_CEE6FA03639666D6 (meal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meal_goal_day (id INT AUTO_INCREMENT NOT NULL, water_intake DOUBLE PRECISION NOT NULL, water DOUBLE PRECISION NOT NULL, number_meals INT NOT NULL, calorie INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meal_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, meal_goal_day_id INT DEFAULT NULL, glucose_goal_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, birthdate DATE NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, acces_at DATETIME NOT NULL, is_active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D6499EBF32EA (meal_goal_day_id), INDEX IDX_8D93D649EF629A11 (glucose_goal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE water (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, quantity DOUBLE PRECISION NOT NULL, created_at DATE NOT NULL, INDEX IDX_FB3314DAA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE additional_information ADD CONSTRAINT FK_19D9524DA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE glucose ADD CONSTRAINT FK_CEAB6699A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE meal ADD CONSTRAINT FK_9EF68E9CBCFF3E8A FOREIGN KEY (meal_type_id) REFERENCES meal_type (id)');
        $this->addSql('ALTER TABLE meal ADD CONSTRAINT FK_9EF68E9CA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE meal_food ADD CONSTRAINT FK_CEE6FA03BA8E87C4 FOREIGN KEY (food_id) REFERENCES food (id)');
        $this->addSql('ALTER TABLE meal_food ADD CONSTRAINT FK_CEE6FA03639666D6 FOREIGN KEY (meal_id) REFERENCES meal (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D6499EBF32EA FOREIGN KEY (meal_goal_day_id) REFERENCES meal_goal_day (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649EF629A11 FOREIGN KEY (glucose_goal_id) REFERENCES glucose_goal (id)');
        $this->addSql('ALTER TABLE water ADD CONSTRAINT FK_FB3314DAA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE additional_information DROP FOREIGN KEY FK_19D9524DA76ED395');
        $this->addSql('ALTER TABLE glucose DROP FOREIGN KEY FK_CEAB6699A76ED395');
        $this->addSql('ALTER TABLE meal DROP FOREIGN KEY FK_9EF68E9CBCFF3E8A');
        $this->addSql('ALTER TABLE meal DROP FOREIGN KEY FK_9EF68E9CA76ED395');
        $this->addSql('ALTER TABLE meal_food DROP FOREIGN KEY FK_CEE6FA03BA8E87C4');
        $this->addSql('ALTER TABLE meal_food DROP FOREIGN KEY FK_CEE6FA03639666D6');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D6499EBF32EA');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649EF629A11');
        $this->addSql('ALTER TABLE water DROP FOREIGN KEY FK_FB3314DAA76ED395');
        $this->addSql('DROP TABLE additional_information');
        $this->addSql('DROP TABLE food');
        $this->addSql('DROP TABLE glucose');
        $this->addSql('DROP TABLE glucose_goal');
        $this->addSql('DROP TABLE meal');
        $this->addSql('DROP TABLE meal_food');
        $this->addSql('DROP TABLE meal_goal_day');
        $this->addSql('DROP TABLE meal_type');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE water');
    }
}
