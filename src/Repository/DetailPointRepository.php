<?php

namespace App\Repository;

use App\Entity\DetailPoint;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DetailPoint|null find($id, $lockMode = null, $lockVersion = null)
 * @method DetailPoint|null findOneBy(array $criteria, array $orderBy = null)
 * @method DetailPoint[]    findAll()
 * @method DetailPoint[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetailPointRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DetailPoint::class);
    }

    // /**
    //  * @return DetailPoint[] Returns an array of DetailPoint objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DetailPoint
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
