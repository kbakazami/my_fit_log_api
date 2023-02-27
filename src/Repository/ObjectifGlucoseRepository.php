<?php

namespace App\Repository;

use App\Entity\ObjectifGlucose;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ObjectifGlucose>
 *
 * @method ObjectifGlucose|null find($id, $lockMode = null, $lockVersion = null)
 * @method ObjectifGlucose|null findOneBy(array $criteria, array $orderBy = null)
 * @method ObjectifGlucose[]    findAll()
 * @method ObjectifGlucose[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ObjectifGlucoseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ObjectifGlucose::class);
    }

    public function save(ObjectifGlucose $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ObjectifGlucose $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ObjectifGlucose[] Returns an array of ObjectifGlucose objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ObjectifGlucose
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
