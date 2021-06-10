<?php

namespace App\Repository;

use App\Entity\DetailTon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DetailTon|null find($id, $lockMode = null, $lockVersion = null)
 * @method DetailTon|null findOneBy(array $criteria, array $orderBy = null)
 * @method DetailTon[]    findAll()
 * @method DetailTon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetailTonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DetailTon::class);
    }

    // /**
    //  * @return DetailTon[] Returns an array of DetailTon objects
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
    public function findOneBySomeField($value): ?DetailTon
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
