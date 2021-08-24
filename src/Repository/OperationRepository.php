<?php

namespace App\Repository;

use App\Entity\Operation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
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

    public function allSt(){
        return $this->createQueryBuilder('o')
            ->orderBy('o.id','DESC')
            ->getQuery()
            ->getResult();
    }

    public function updateSolde($operation,$solde)
    {
        return $this->createQueryBuilder('o')
            ->update()
            ->set('o.solde', '?1')
            ->where('o.id =?2')
            ->setParameter(1, $solde)
            ->setParameter(2, $operation)
            ->getQuery()
            ->execute()
            ;
    }


    public function findAllAppointement($tontine)
    {

        $em=$this->getEntityManager();
        $query=$em->createQuery(
            "
    SELECT op.id, pd.code periode, op.datecomptabilisation, 
   cp.numcomp, op.devise, op.libelleop,(CASE WHEN op.sens='D' THEN op.montantop ELSE 0 END) debit,
   (CASE WHEN op.sens='C' THEN op.montantop ELSE 0 END) credit, 
   op.solde, cl.nomcomplet client, CONCAT(us.prenom,CONCAT(' ',us.nom)) agent
    FROM App\Entity\Operation op, App\Entity\Compte cp, App\Entity\Periode pd, App\Entity\Client cl,
    App\Entity\Agence agc,App\Entity\User us, App\Entity\Tontine tt
    WHERE op.compte=cp.id
    AND op.periode=pd.id
    AND op.client=cl.id
    AND op.agence=agc.id
    AND op.createdBy=us.id
    AND cp.id=tt.compte
    ORDER BY op.id DESC
                "
        );//->setParameter('idtontine',$tontine);

    return $query->getArrayResult();

    }


    public function findAllAppointement__()
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
