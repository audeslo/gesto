<?php

namespace App\Repository;

use App\Entity\Tontine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tontine|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tontine|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tontine[]    findAll()
 * @method Tontine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TontineRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tontine::class);
    }

    public function updateSoldeTontine($tontine,$solde)
    {
        return $this->createQueryBuilder('t')
            ->update()
            ->set('t.solde', '?1')
            ->where('t.id =?2')
            ->setParameter(1, $solde)
            ->setParameter(2, $tontine)
            ->getQuery()
            ->execute()
            ;
    }

    public function clotureTontine($tontine,$mtcollecte)
    {
        return $this->createQueryBuilder('t')
            ->update()
            ->set('t.solde', '?1')
            ->set('t.niveau','?3')
            ->set('t.mtcollecte','?4')
            ->where('t.id =?2')
            ->setParameter(1, 0)
            ->setParameter(2, $tontine)
            ->setParameter(3, 'closed')
            ->setParameter(4, $mtcollecte)
            ->getQuery()
            ->execute()
            ;
    }

    public function updateNbAppointement($tontine,$reste)
    {
        return $this->createQueryBuilder('t')
            ->update()
            ->set('t.appointrest', '?1')
            ->where('t.id =?2')
            ->setParameter(1, $reste)
            ->setParameter(2, $tontine)
            ->getQuery()
            ->execute()
            ;
    }

    public function updateAvance($tontine,$avance)
    {
        return $this->createQueryBuilder('t')
            ->update()
            ->set('t.avance', '?1')
            ->where('t.id =?2')
            ->setParameter(1, $avance)
            ->setParameter(2, $tontine)
            ->getQuery()
            ->execute()
            ;
    }

    // /**
    //  * @return Tontine[] Returns an array of Tontine objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Tontine
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
