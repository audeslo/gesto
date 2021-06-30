<?php

namespace App\Repository;

use App\Entity\Detailcaisse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Detailcaisse|null find($id, $lockMode = null, $lockVersion = null)
 * @method Detailcaisse|null findOneBy(array $criteria, array $orderBy = null)
 * @method Detailcaisse[]    findAll()
 * @method Detailcaisse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetailcaisseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Detailcaisse::class);
    }

    // /**
    //  * @return Detailcaisse[] Returns an array of Detailcaisse objects
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
    public function findOneBySomeField($value): ?Detailcaisse
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
