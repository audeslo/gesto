<?php

namespace App\Repository;

use App\Entity\Detailtontine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
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

    public function findAllDetailOperation()
    {
        return $this->createQueryBuilder('dt')
            ->select("op.libelleop,op.datecomptabilisation,op.slug,
            ag.libelle,op.sens, op.cancel, cpt.numcomp, op.dateop,op.nomcomplet,
            op.montantop, CONCAT(cl.nom,CONCAT(' ',cl.prenoms)) client
            ")
            ->join('dt.tontine','tt')
            ->join('tt.compte','cpt')
            ->join('dt.operation','op')
            ->join('op.agence','ag')
            ->join('op.client','cl')
            //->andWhere('cpt.type = :val')
            //->setParameter('val', '01')
            ->orderBy('op.dateop', 'DESC')
            ->groupBy('op.libelleop,op.datecomptabilisation,op.slug,
            ag.libelle,op.sens, op.cancel, cpt.numcomp, op.dateop,op.nomcomplet,
            op.montantop,client
            ')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findAllDebit($tontine)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.tontine = :val')
            ->setParameter('val', $tontine)
            ->orderBy('d.id', 'ASC')
            //->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findEtatCompteTontine($tontine)
    {
        $em=$this->getEntityManager();
        $query=$em->createQuery(
       "SELECT IDENTITY (op.compte) compte,SUM (CASE WHEN op.sens='D' 
            THEN dt.meconomie ELSE 0 END)+ (tt.avance+tt.mtcollecte) debit,SUM(CASE WHEN op.sens='C' 
            THEN dt.meconomie ELSE 0 END) credit,tt.avance,-1*((SUM (CASE WHEN 
            op.sens='D' THEN dt.meconomie ELSE 0 END)-SUM(CASE WHEN op.sens='C' 
	        THEN dt.meconomie ELSE 0 END)) + (tt.avance+tt.mtcollecte) ) soldecli
       FROM App\Entity\Operation op, App\Entity\Detailtontine dt,
            App\Entity\Tontine tt
       WHERE dt.operation=op
       AND tt=dt.tontine
       AND dt.tontine =:idtontine
       GROUP BY op.compte,tt.avance,tt.mtcollecte"
        )->setParameter('idtontine',$tontine);
        try {
            return $query->getSingleResult();
        } catch (NoResultException | NonUniqueResultException $e) {
        }
    }


/*$em=$this->getEntityManager();
$query=$em->createQuery(
'SELECT p.nomFrFr, n.nationalite
                FROM App\Entity\Nationalite n, App\Entity\Pays p
                WHERE p.alpha2=n.code
                AND   n.id =:idNationalite
                ORDER BY p.nomFrFr ASC'
)->setParameter('idNationalite',$tontine);
return $query->getResult();*/




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
