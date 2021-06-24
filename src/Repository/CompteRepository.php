<?php

namespace App\Repository;

use App\Entity\Compte;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Compte|null find($id, $lockMode = null, $lockVersion = null)
 * @method Compte|null findOneBy(array $criteria, array $orderBy = null)
 * @method Compte[]    findAll()
 * @method Compte[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Compte::class);
    }
    public function findLastCompteId()
    {
        try {
            return $this->createQueryBuilder('cpt')
                ->select('cpt.id')
                ->orderBy('cpt.id', 'DESC')
                ->setMaxResults(1)
                ->getQuery()
                ->getSingleScalarResult();
        } catch (NoResultException $e) {
        } catch (NonUniqueResultException $e) {
        }
    }

    public function updateCompte($debit,$credit,$solde,$compte)
    {
        return $this->createQueryBuilder('c')
            ->update()
            ->set('c.cpcmd', '?1')
            ->set('c.cpcmc','?2')
            ->set ('c.solde','?3')
            ->set ('c.derniereop','?4')
            ->where('c.id =?5')
            ->setParameter(1,$debit )
            ->setParameter(2, $credit)
            ->setParameter(3, $solde)
            ->setParameter(4,new \DateTimeImmutable("now"))
            ->setParameter(5, $compte)
            ->getQuery()
            ->execute()
            ;
    }

    // /**
    //  * @return Compte[] Returns an array of Compte objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Compte
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
