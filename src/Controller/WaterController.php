<?php

namespace App\Controller;

use App\Entity\Water;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;


class WaterController extends AbstractController
{

    private $entityManager;
    private $serializer;

    public function __construct(EntityManagerInterface $entityManager, SerializerInterface $serializer)
    {
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
    }


    // ////////////////////////////////////////////////////////////
    #[Route('/api/waterCurrentdate/{id}', name: 'app_water_current_date')]
    public function waterCurrentDate($id): Response
    {
        $waters = $this->entityManager->getRepository(Water::class)->findBy(['user' => $id]);
        $allWater=[];
        $currentDate = date("Y-m-d");
        foreach($waters as $water)
        {
            $date = $water->getCreatedAt()->format("Y-m-d");
            if($currentDate == $date)
            {

                $allWater[$water->getId()]["note"] = $water->getNote();
                $allWater[$water->getId()]["date"] = $date;
                $allWater[$water->getId()]['waterType'] = $water->getwaterType()->getName();
            

                /*

                $water=$water->getwaterFood();
                foreach($waterFoods as $waterFood){
                    $foods = $this->entityManager->getRepository(Food::class)->findById($waterFood->getFood()->getId());
                    foreach($foods as $food){
                        // dump($food);
                        $allWater[$water->getId()]['waterFood'][$waterFood->getFood()->getId()]['quantity'] = $waterFood->getQuantity();
                        $allWater[$water->getId()]['waterFood'][$waterFood->getFood()->getId()]['defautGrams'] = $food->getDefaultGrams();
                        $allWater[$water->getId()]['waterFood'][$waterFood->getFood()->getId()]['name'] = $food->getName();
                        $allWater[$water->getId()]['waterFood'][$waterFood->getFood()->getId()]['calorie'] = $food->getCalorie();
                        $allWater[$water->getId()]['waterFood'][$waterFood->getFood()->getId()]['waterIntake'] = $food->getWaterIntake();
                        $allWater[$water->getId()]['waterFood'][$waterFood->getFood()->getId()]['fiber'] = $food->getFiber();
                        $allWater[$water->getId()]['waterFood'][$waterFood->getFood()->getId()]['protein'] = $food->getProtein();
                        $allWater[$water->getId()]['waterFood'][$waterFood->getFood()->getId()]['carbohydrate'] = $food->getCarbohydrate();
                        $allWater[$water->getId()]['waterFood'][$waterFood->getFood()->getId()]['lipid'] = $food->getLipid();
                    }
                }*/
            }
        }
        dump($allWater);
        
        // return new JsonResponse($allWater);

    }

}
