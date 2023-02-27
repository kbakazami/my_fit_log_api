<?php

namespace App\Repository;

use App\Entity\ObjectifAlimentation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ObjectifAlimentation>
 *
 * @method ObjectifAlimentation|null find($id, $lockMode = null, $lockVersion = null)
 * @method ObjectifAlimentation|null findOneBy(array $criteria, array $orderBy = null)
 * @method ObjectifAlimentation[]    findAll()
 * @method ObjectifAlimentation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ObjectifAlimentationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ObjectifAlimentation::class);
    }

    public function save(ObjectifAlimentation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ObjectifAlimentation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ObjectifAlimentation[] Returns an array of ObjectifAlimentation objects
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

//    public function findOneBySomeField($value): ?ObjectifAlimentation
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
