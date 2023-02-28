<?php

namespace App\Controller;

use App\Entity\ObjectifGlucose;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class ObjectifGlucoseController extends AbstractController
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
        $entity->setGlycemiemin($data['glycemiemin']);
        $entity->setGlycemiemax($date['glycemiemax']);
        $entity->setGlycemiemaxa($data['glycemiemaxa']);
        $entity->setGlycemiemina($data['glycemiemina']);
        $entity->setUserId($id);
        $entityManager->persist($entity);
        $entityManager->flush();
        // return $this->render('glucose/index.html.twig', [
        //     'controller_name' => 'GlucoseController',
        // ]);

        return $this->json(['message' => 'Données enregistrées avec succès.']);
    }

     // Get objectif d'un personne
     #[Route('/glucose/getObjectifGlucose/{id}', name: 'app_glucose_get_objectif')]
     public function getObjectifGlucose($id): Response
     {
        $objectifGlucose = $this->entityManager->getRepository(ObjectifGlucose::class)->findOneByUserId($id);
 
        // return $this->render('glucose/index.html.twig', [
        //     'controller_name' => 'GlucoseController',
        // ]);
 
        return json_encode($objectifGlucose);
     }
 
     //Update objectif d'une personne
     #[Route('/glucose/updateObjectifGlucose/{id}', name: 'app_glucose_update_objectif')]
     public function updateObjectifGlucose($id): Response
     {
        $jsonString = $request->getContent();
       
        $data = json_decode($jsonString, true);

        $objectifGlucose = $this->entityManager->getRepository(ObjectifGlucose::class)->findOneByUserId($id);

        $objectifGlucose->setGlycemiemin($data['glycemiemin']);
        $objectifGlucose->setGlycemiemax($date['glycemiemax']);
        $objectifGlucose->setGlycemiemaxa($data['glycemiemaxa']);
        $objectifGlucose->setGlycemiemina($data['glycemiemina']);
        $this->entityManager->flush();
        // return $this->render('glucose/index.html.twig', [
        //     'controller_name' => 'GlucoseController',
        // ]);

        return $this->json(['message' => 'Données mise à jours.']);
     }
}
