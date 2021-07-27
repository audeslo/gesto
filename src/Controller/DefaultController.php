<?php

namespace App\Controller;

use App\Repository\DetailtontineRepository;
use App\Repository\OperationRepository;
use App\Repository\ParametreRepository;
use App\Repository\PeriodeRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\DataFromDB;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="Accueil")
     */
    public function index(): Response
    {


        return $this->render('base.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("/session_user", name="session_user")
     */
    public function session(): Response
    {
        // Récupérer des information juste à l'ouverture de la session

        $em=$this->getDoctrine()->getManager();
        $ip=$_SERVER['REMOTE_ADDR'];
        $em->getRepository('App:User')->upDatelastLogin($this->getUser()->getId(),$ip);


        return $this->render('base.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("/test", name="test")
     */
    public function test(DetailtontineRepository $detailtontineRepository, DataFromDB $dataFromDB): Response
    {

        dd($detailtontineRepository->findAllDetailOperation());
        return false;

        return $this->render('base.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

}
