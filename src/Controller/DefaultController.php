<?php

namespace App\Controller;

use App\Repository\OperationRepository;
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
     * @Route("/test", name="test")
     */
    public function test(OperationRepository $operationRepository): Response
    {
        dump($operationRepository->findOperationTontine());
        return false;

        return $this->render('base.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

}
