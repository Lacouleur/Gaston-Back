<?php

namespace App\Repository;

use App\Entity\WearCondition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method WearCondition|null find($id, $lockMode = null, $lockVersion = null)
 * @method WearCondition|null findOneBy(array $criteria, array $orderBy = null)
 * @method WearCondition[]    findAll()
 * @method WearCondition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WearConditionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WearCondition::class);
    }

    // /**
    //  * @return WearCondition[] Returns an array of WearCondition objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WearCondition
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
