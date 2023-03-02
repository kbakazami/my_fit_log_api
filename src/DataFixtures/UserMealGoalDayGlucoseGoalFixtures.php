<?php namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\MealGoalDay;
use App\Entity\GlucoseGoal;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $mealGoalDay = new MealGoalDay();
        $mealGoalDay->setWaterIntake('98.2');
        $mealGoalDay->setWater('2');
        $mealGoalDay->setNumberMeals('3');
        $mealGoalDay->setCalorie('2000');
        $manager->persist($mealGoalDay);
        $manager->flush();

        $glucoseGoal = new GlucoseGoal();
        $glucoseGoal->setGlucoseMin('1.2');
        $glucoseGoal->setGlucoseMax('2');
        $glucoseGoal->setGlucoseMinF('0.8');
        $glucoseGoal->getGlucoseMaxF('1');
        $manager->persist($glucoseGoal);
        $manager->flush();
    }
}