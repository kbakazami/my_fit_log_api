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

                $allWater[$water->getId()] = $water;
            }
        }
        // dump($allWater);
        return new JsonResponse($allWater);

    }

}
