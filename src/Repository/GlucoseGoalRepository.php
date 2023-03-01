<?php

namespace App\Repository;

use App\Entity\GlucoseGoal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GlucoseGoal>
 *
 * @method GlucoseGoal|null find($id, $lockMode = null, $lockVersion = null)
 * @method GlucoseGoal|null findOneBy(array $criteria, array $orderBy = null)
 * @method GlucoseGoal[]    findAll()
 * @method GlucoseGoal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GlucoseGoalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GlucoseGoal::class);
    }

    public function save(GlucoseGoal $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(GlucoseGoal $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return GlucoseGoal[] Returns an array of GlucoseGoal objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?GlucoseGoal
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
