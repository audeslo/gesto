<?php

namespace App\Controller;

use App\Repository\CompteRepository;
use App\Repository\DetailtontineRepository;
use App\Repository\OperationRepository;
use App\Repository\TontineRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
     * @Route("/test", name="Accueil")
     */
    public function test(CompteRepository $compteRepository): Response
    {
        dump($compteRepository->updateCompte(5000,38000,1750,1));
        return false;

        return $this->render('base.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
}
