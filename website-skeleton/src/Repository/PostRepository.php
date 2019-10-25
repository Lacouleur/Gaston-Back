<?php

namespace App\Repository;

use App\Entity\Post;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Post::class);
    }
    
    /**
      * @return Post[] Returns an array of Post objects
      */
    public function findAllClosePosts($lat, $lng): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 
            'SELECT
                id, (
                    6371 * acos (
                        cos ( radians(' . $lat . ') )
                        * cos( radians( lat ) )
                        * cos( radians( lng ) - radians(' . $lng . ') )
                        + sin ( radians(' . $lat . ') )
                        * sin( radians( lat ) )
                    )
                ) AS distance
            FROM post
            HAVING distance < 1000
            ORDER BY distance'
        ;
        $stmt = $conn->prepare($sql);
        $stmt->execute(['lat' => $lat, 'lng' => $lng]);

        return $stmt->fetchAll();
    }
    
    // /**
    //  * @return Post[] Returns an array of Post objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Post
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
