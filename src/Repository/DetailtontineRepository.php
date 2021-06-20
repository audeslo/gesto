<?php

namespace App\Repository;

use App\Entity\Detailtontine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Detailtontine|null find($id, $lockMode = null, $lockVersion = null)
 * @method Detailtontine|null findOneBy(array $criteria, array $orderBy = null)
 * @method Detailtontine[]    findAll()
 * @method Detailtontine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetailtontineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Detailtontine::class);
    }

    // /**
    //  * @return Detailtontine[] Returns an array of Detailtontine objects
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
    public function findOneBySomeField($value): ?Detailtontine
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
