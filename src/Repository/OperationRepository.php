<?php

namespace App\Repository;

use App\Entity\Operation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Operation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Operation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Operation[]    findAll()
 * @method Operation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OperationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Operation::class);
    }

    public function findAllAppointement()
    {
        return $this->createQueryBuilder('o')
            ->join('o.compte','cpt')
            ->andWhere('cpt.type = :val')
            ->setParameter('val', '01')
            ->orderBy('o.dateop', 'DESC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findAllAvancement()
    {
        return $this->createQueryBuilder('o')
            ->join('o.compte','cpt')
            ->join('cpt.tontines','tt')
            ->join('tt.avancements','avan')
            ->andWhere('cpt.type = :val')
            ->setParameter('val', '01')
            ->orderBy('o.dateop', 'DESC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }


    // /**
    //  * @return Operation[] Returns an array of Operation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Operation
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
