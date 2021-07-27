<?php

namespace App\Repository;

use App\Entity\Periode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Periode|null find($id, $lockMode = null, $lockVersion = null)
 * @method Periode|null findOneBy(array $criteria, array $orderBy = null)
 * @method Periode[]    findAll()
 * @method Periode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PeriodeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Periode::class);
    }

    /**
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\NoResultException
     */
    public function findPeriodeActuelle()
    {
        return $this->createQueryBuilder('p')
            ->andWhere(':now BETWEEN p.debut AND p.fin')
            ->setParameter('now', new \DateTimeImmutable('now'))
            ->getQuery()
            ->getSingleResult()
            ;
    }

    public function findAllPeriodes()
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.annee', 'DESC')
            ->addOrderBy('p.valeur', 'ASC')
            ->setMaxResults(36)
            ->getQuery()
            ->getResult()
            ;
    }

    public function updatePeriodeClos()
    {
        return $this->createQueryBuilder('p')
            ->update()
            ->set('p.etat', '?1')
            ->where('p.fin <?2')
            ->setParameter(1, "Clos")
            ->setParameter(2, new \DateTimeImmutable("now"))
            ->getQuery()
            ->execute()
            ;
    }

    // /**
    //  * @return Periode[] Returns an array of Periode objects
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
    public function findOneBySomeField($value): ?Periode
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
