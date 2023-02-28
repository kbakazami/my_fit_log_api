<?php

namespace App\Controller;

use App\Entity\Glucose;
use App\Entity\ObjectifGlucose;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class GlucoseController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    // Toutes les données pour un utilisateur
    #[Route('/glucose/allValues/{id}', name: 'app_glucose_all_values')]
    public function allGlucose($id): Response
    {
        $glucose = $this->entityManager->getRepository(Glucose::class)->findOneByUserId($id);
        // return $this->render('glucose/index.html.twig', [
        //     'controller_name' => 'GlucoseController',
        // ]);

        return json_encode($glucose);
    }

    // Toutes les données entre deux date
    #[Route('/glucose/dateGlucose/{id}, {strartdate}, {enddate}', name: 'app_glucose_date')]
    public function dateGlucose($id, $startDate, $endDate): Response
    {
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->select('*')
            ->from('App\Entity\Glucose')
            ->where('horaire BETWEEN :startDate AND :endDate')
            ->andWhere('userId = :id')
            ->setParameter('startDate', $startDate)
            ->setParameter('endDate', $endDate)
            ->setParameter('id', $id);


        $results = $queryBuilder->getQuery()->getResult();
        // return $this->render('glucose/index.html.twig', [
        //     'controller_name' => 'GlucoseController',
        // ]);

        return json_encode($results);
    }

    // Set une donnée d'une personne
    #[Route('/glucose/addGlucose/{id}', name: 'app_glucose_add_glucose')]
    public function addGlucose($id): Response
    {
        $jsonString = $request->getContent();
       
        $data = json_decode($jsonString, true);

        $entity = new Glucose();
        $entity->setTaux($data['taux']);
        $entity->setAjeun($date['ajeun']);
        $entity->setHoraire($data['horaire']);
        $entity->setUserId($id);
        $entityManager->persist($entity);
        $entityManager->flush();
        // return $this->render('glucose/index.html.twig', [
        //     'controller_name' => 'GlucoseController',
        // ]);

        return $this->json(['message' => 'Données enregistrées avec succès.']);
    }

    // get dernière donnée d'une personne
    #[Route('/glucose/getLastGlucoas/{id}', name: 'app_glucose_get_last_glucose')]
    public function getLastGlucose($id): Response
    {
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->select('*')
            ->from('App\Entity\Glucose')
            ->Where('userId = :id')
            ->orderBy('u.id', 'DESC')
            ->setMaxResults(1)
            ->setParameter('id', $id);


        $results = $queryBuilder->getQuery()->getResult();
        // return $this->render('glucose/index.html.twig', [
        //     'controller_name' => 'GlucoseController',
        // ]);

        return json_encode($results);
    } 
}
