<?php

namespace App\Controller;

use App\Entity\Meal;
use App\Entity\Food;
use App\Entity\MealFood;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

class MealController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    // get all alimentation pour un utilisateur
    #[Route('/api/allMeal/{id}', name: 'app_meal_all')]
    public function allMeal($id): Response
    {
        $meals = $this->entityManager->getRepository(Meal::class)->findBy(['user' => $id]);
        $allMealFood=[];
        foreach($meals as $meal)
        {
            $date = $meal->getCreatedAt()->format("Y-m-d");
            $allMealFood[$meal->getId()]["note"] = $meal->getNote();
            $allMealFood[$meal->getId()]["date"] = $date;
            $allMealFood[$meal->getId()]['mealType'] = $meal->getMealType()->getName();
            $mealFoods=$meal->getMealFood();
            foreach($mealFoods as $mealFood){
                $foods = $this->entityManager->getRepository(Food::class)->findById($mealFood->getFood()->getId());
                foreach($foods as $food){
                    // dump($food);
                    $allMealFood[$meal->getId()]['mealFood'][$mealFood->getFood()->getId()]['quantity'] = $mealFood->getQuantity();
                    $allMealFood[$meal->getId()]['mealFood'][$mealFood->getFood()->getId()]['defautGrams'] = $food->getDefaultGrams();
                    $allMealFood[$meal->getId()]['mealFood'][$mealFood->getFood()->getId()]['name'] = $food->getName();
                    $allMealFood[$meal->getId()]['mealFood'][$mealFood->getFood()->getId()]['calorie'] = $food->getCalorie();
                    $allMealFood[$meal->getId()]['mealFood'][$mealFood->getFood()->getId()]['waterIntake'] = $food->getWaterIntake();
                    $allMealFood[$meal->getId()]['mealFood'][$mealFood->getFood()->getId()]['fiber'] = $food->getFiber();
                    $allMealFood[$meal->getId()]['mealFood'][$mealFood->getFood()->getId()]['protein'] = $food->getProtein();
                    $allMealFood[$meal->getId()]['mealFood'][$mealFood->getFood()->getId()]['carbohydrate'] = $food->getCarbohydrate();
                    $allMealFood[$meal->getId()]['mealFood'][$mealFood->getFood()->getId()]['lipid'] = $food->getLipid();
                }
            }
        }
        return new JsonResponse($allMealFood);
    }

    //Tout les repas de la journée
    #[Route('/api/mealCurrentDay/{id}', name: 'app_meal_current_day')]
    public function mealCurrentDay($id): Response
    {
        $meals = $this->entityManager->getRepository(Meal::class)->findBy(['user' => $id]);
        $allMealFood=[];
        $currentDate = date("Y-m-d");
        foreach($meals as $meal)
        {
            $date = $meal->getCreatedAt()->format("Y-m-d");
            if($currentDate == $date)
            {
                $allMealFood[$meal->getId()]["note"] = $meal->getNote();
                $allMealFood[$meal->getId()]["date"] = $date;
                $allMealFood[$meal->getId()]['mealType'] = $meal->getMealType()->getName();
            
                $mealFoods=$meal->getMealFood();
                foreach($mealFoods as $mealFood){
                    $foods = $this->entityManager->getRepository(Food::class)->findById($mealFood->getFood()->getId());
                    foreach($foods as $food){
                        // dump($food);
                        $allMealFood[$meal->getId()]['mealFood'][$mealFood->getFood()->getId()]['quantity'] = $mealFood->getQuantity();
                        $allMealFood[$meal->getId()]['mealFood'][$mealFood->getFood()->getId()]['defautGrams'] = $food->getDefaultGrams();
                        $allMealFood[$meal->getId()]['mealFood'][$mealFood->getFood()->getId()]['name'] = $food->getName();
                        $allMealFood[$meal->getId()]['mealFood'][$mealFood->getFood()->getId()]['calorie'] = $food->getCalorie();
                        $allMealFood[$meal->getId()]['mealFood'][$mealFood->getFood()->getId()]['waterIntake'] = $food->getWaterIntake();
                        $allMealFood[$meal->getId()]['mealFood'][$mealFood->getFood()->getId()]['fiber'] = $food->getFiber();
                        $allMealFood[$meal->getId()]['mealFood'][$mealFood->getFood()->getId()]['protein'] = $food->getProtein();
                        $allMealFood[$meal->getId()]['mealFood'][$mealFood->getFood()->getId()]['carbohydrate'] = $food->getCarbohydrate();
                        $allMealFood[$meal->getId()]['mealFood'][$mealFood->getFood()->getId()]['lipid'] = $food->getLipid();
                    }
                }
            }
        }
        return new JsonResponse($allMealFood);
    }

    //Tout les repas entre deux dates
    #[Route('/api/mealBtwDate/{id}/{startdate}/{enddate}', name: 'app_meal_btw_date')]
    public function mealBtwDate($id, $startdate, $enddate): Response
    {
        $meals = $this->entityManager->getRepository(Meal::class)->findBy(['user' => $id]);
        $allMealFood=[];
        foreach($meals as $meal)
        {
            $date = $meal->getCreatedAt()->format("Y-m-d");
            if(($date >= $startdate) && ($date <= $enddate))
            {
                $allMealFood[$meal->getId()]["note"] = $meal->getNote();
                $allMealFood[$meal->getId()]["date"] = $date;
                $allMealFood[$meal->getId()]['mealType'] = $meal->getMealType()->getName();
            
                $mealFoods=$meal->getMealFood();
                foreach($mealFoods as $mealFood){
                    $foods = $this->entityManager->getRepository(Food::class)->findById($mealFood->getFood()->getId());
                    foreach($foods as $food){
                        // dump($food);
                        $allMealFood[$meal->getId()]['mealFood'][$mealFood->getFood()->getId()]['quantity'] = $mealFood->getQuantity();
                        $allMealFood[$meal->getId()]['mealFood'][$mealFood->getFood()->getId()]['defautGrams'] = $food->getDefaultGrams();
                        $allMealFood[$meal->getId()]['mealFood'][$mealFood->getFood()->getId()]['name'] = $food->getName();
                        $allMealFood[$meal->getId()]['mealFood'][$mealFood->getFood()->getId()]['calorie'] = $food->getCalorie();
                        $allMealFood[$meal->getId()]['mealFood'][$mealFood->getFood()->getId()]['waterIntake'] = $food->getWaterIntake();
                        $allMealFood[$meal->getId()]['mealFood'][$mealFood->getFood()->getId()]['fiber'] = $food->getFiber();
                        $allMealFood[$meal->getId()]['mealFood'][$mealFood->getFood()->getId()]['protein'] = $food->getProtein();
                        $allMealFood[$meal->getId()]['mealFood'][$mealFood->getFood()->getId()]['carbohydrate'] = $food->getCarbohydrate();
                        $allMealFood[$meal->getId()]['mealFood'][$mealFood->getFood()->getId()]['lipid'] = $food->getLipid();
                    }
                }
            }
        }
        return new JsonResponse($allMealFood);
    }

    //Ajouter un repas DEPRECIER
    #[Route('/api/addMeal/{id}', name: 'app_meal_add')]
    public function addMeal($id): Response
    {
        $food = $this->entityManager->getRepository(Meal::class)->findOneByID($data["food"]);
        $meal = new Meal();
        $currentDate = date("Y-m-d");
        $meal->setCreatedAd($currentDate);
        $meal->setNote($data['note']);
        $meal->setMealType($data['mealTypeId']);
        $meal->setUser($id);
        $entityManager->persist($meal);
        $entityManager->flush();

        $entity = new MealFood();
        $entity->setFood($food);
        $entity->setMeal($meal);
        $entity->setQuantity($data['quantity']);
        $entityManager->persist($entity);
        $entityManager->flush();
        
    }
}
