<?php

namespace App\Controller;

use App\Entity\GlucoseGoal;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

class GlucoseGoalController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    // Set objectif d'une personne
    #[Route('/glucose/addObjectifGlucose/{id}', name: 'app_glucose_add_objectif')]
    public function addObjectifGlucose($id): Response
    {
        $jsonString = $request->getContent();
       
        $data = json_decode($jsonString, true);

        $entity = new ObjectifGlucose();
        $entity->setGlucoseMin($data['glucoseMin']);
        $entity->setGlucoseMax($date['glucoseMax']);
        $entity->setGlucoseMinF($data['glucoseMinF']);
        $entity->setGlucoseMaxF($data['glucoseMaxF']);
        $entity->addUser($id);
        $entityManager->persist($entity);
        $entityManager->flush();
        // return $this->render('glucose/index.html.twig', [
        //     'controller_name' => 'GlucoseController',
        // ]);

        return $this->json(['message' => 'Données enregistrées avec succès.']);
    }

    // Get objectif d'un personne
    // MARCHE PAAAAAAAAAAAAAAAAAS
    #[Route('/glucose/getGlucoseGoal/{id}', name: 'app_glucose_get_objectif')]
    public function getObjectifGlucose($id): Response
    {
        $user = $this->entityManager->getRepository(User::class)->find($id);
        $glucoseGoal = $user->getGlucoseGoal();
 
        // return $this->render('glucose/index.html.twig', [
        //     'controller_name' => 'GlucoseController',
        // ]);
        dump($glucoseGoal);
        return $this->render('base.html.twig', [
            'controller_name' => 'GlucoseController',
        ]);
        // return json_encode($objectifGlucose);
    }
 
    //Update objectif d'une personne
    #[Route('/glucose/updateObjectifGlucose/{id}', name: 'app_glucose_update_objectif')]
    public function updateObjectifGlucose($id): Response
    {
        $jsonString = $request->getContent();
       
        $data = json_decode($jsonString, true);

        $objectifGlucose = $this->entityManager->getRepository(ObjectifGlucose::class)->findOneByUserId($id);

        $objectifGlucose->setGlucoseMin($data['glucoseMin']);
        $objectifGlucose->setGlucoseMax($date['glucoseMax']);
        $objectifGlucose->setGlucoseMinF($data['glucoseMinF']);
        $objectifGlucose->setGlucoseMaxF($data['glucoseMaxF']);
        $this->entityManager->flush();
        // return $this->render('glucose/index.html.twig', [
        //     'controller_name' => 'GlucoseController',
        // ]);

        return $this->json(['message' => 'Données mise à jours.']);
    }
}
