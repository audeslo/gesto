<?php


namespace App\Service;


use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

class DataFromDB
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface  $em)
    {
        $this->em=$em;
    }

    public function getDevise()
    {

        try {
            $devise=$this->em->getRepository('App:Parametre')->findDevise();
        } catch (NoResultException | NonUniqueResultException $e) {
            return $this->dd([
                'message' => 'Aucune devise n\'est configurée.',
                'erreur'    => true
            ],200);
        }

        return $devise['devise'];
    }

    public function getPeriode()
    {
        try {
            $periode = $this->em->getRepository('App:Periode')->findPeriodeActuelle();
        } catch (NoResultException | NonUniqueResultException $e) {
            return $this->dd([
                'message' => 'Aucune période n\'est ouverte pour cette opération.',
                'erreur'    => true
            ],200);
        }
        return $periode;
    }
}