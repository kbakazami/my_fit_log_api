<?php

namespace App\Controller;

use App\Entity\Glucose;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

class GlucoseController extends AbstractController
{
    private $entityManager;
    private $serializer;

    public function __construct(EntityManagerInterface $entityManager, SerializerInterface $serializer)
    {
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
    }

    // Toutes les données pour un utilisateur
    #[Route('/glucose/allValues/{id}', name: 'app_glucose_all_values')]
    public function allGlucose($id): Response
    {   
        $glucose = $this->entityManager->getRepository(Glucose::class)->findBy(['user' => $id]);
        dump($glucose);
        // $jsonData = $serializer->serialize($glucose, 'json');
        // dump(json_encode($glucose));

        // return new JsonResponse($jsonData);
        return $this->render('base.html.twig', [
            'controller_name' => 'GlucoseController',
        ]);
    }

    // Toutes les données entre deux date
    #[Route('/glucose/glucose_btw/{id}/{startdate}/{enddate}', name: 'app_glucose_date')]
    public function glucoseBtw($id, $startdate, $enddate): Response
    {
        $queryBuilder = $this->entityManager->createQueryBuilder('g');
        $queryBuilder->select('g')
            ->from(Glucose::class, 'g')
            ->where('g.createdAt BETWEEN :startDate AND :endDate')
            ->andWhere('g.user = :id')
            ->setParameter('startDate', $startdate)
            ->setParameter('endDate', $enddate)
            ->setParameter('id', $id);


        $results = $queryBuilder->getQuery()->getResult();

        dump($results);

        return $this->render('base.html.twig', [
            'controller_name' => 'GlucoseController',
        ]);
        // return json_encode($results);
    }

    // Set une donnée d'une personne
    #[Route('/glucose/addGlucose/{id}', name: 'app_glucose_add_glucose')]
    public function addGlucose($id): Response
    {
        $jsonString = $request->getContent();
       
        $data = json_decode($jsonString, true);

        $entity = new Glucose();
        $entity->setRate($data['rate']);
        $entity->setIsFasting($date['isFasting']);
        $entity->setCreatedAt($data['createdAt']);
        $entity->setUser($id);
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
        $queryBuilder = $this->entityManager->createQueryBuilder('g');
        $queryBuilder->select('g')
            ->from(Glucose::class, 'g')
            ->Where('g.user = :id')
            ->orderBy('g.id', 'DESC')
            ->setMaxResults(1)
            ->setParameter('id', $id);


        $results = $queryBuilder->getQuery()->getResult();
        // return $this->render('glucose/index.html.twig', [
        //     'controller_name' => 'GlucoseController',
        // ]);
        dump($results);
        return $this->render('base.html.twig', [
            'controller_name' => 'GlucoseController',
        ]);

        // return json_encode($results);
    } 
}
