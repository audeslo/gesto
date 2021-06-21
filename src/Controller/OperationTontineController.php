<?php

namespace App\Controller;

use App\Entity\Detailtontine;
use App\Entity\Operation;
use App\Entity\Tontine;
use App\Form\DetailtontineType;
use App\Form\FormTontineType;
use App\Form\OperationTontineType;
use App\Form\TontineType;
use App\Repository\OperationRepository;
use App\Repository\TontineRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class OperationTontineController
 * @package App\Controller
 * @Route("/operation/tontine")
 */
class OperationTontineController extends AbstractController
{

    /**
     * @Route("/", name="operation_tontine_index", methods={"GET","POST"})
     */
    public function index(OperationRepository $operationRepository, Request $request): Response
    {
        $operation = new Operation();
        $tontine = new Tontine();

        $form_operation = $this->createForm(OperationTontineType::class, $operation);
        $form_operation->handleRequest($request);

        $form_tontine = $this->createForm(FormTontineType::class, $tontine);
        $form_tontine->handleRequest($request);

        return $this->render('operation_tontine/index.html.twig', [
            'operation_tontines' => $operationRepository->findAll(),
            'form_operation' => $form_operation->createView(),
            'form_tontine' => $form_tontine->createView(),
            'operation_tontine' => $operation
        ]);
    }

    /**
     * @Route("/remplirchamp", name="operation_tontine_remplirchamp", methods={"GET","POST"})
     * @param TontineRepository $tontineRepository
     * @param Request $request
     * @return Response
     */
    public function remplirChamp(TontineRepository $tontineRepository,Request $request):Response
    {
        $em=$this->getDoctrine()->getManager();
        $operation = new Operation();
        $tontine = new Tontine();

        $form_operation = $this->createForm(OperationTontineType::class, $operation);
        $form_operation->handleRequest($request);

        $form_tontine = $this->createForm(FormTontineType::class, $tontine);
        $form_tontine->handleRequest($request);

        $donnes=$form_operation['tontine']->getData();

        return $this->json([

            'nomcomplet'             => $donnes->getClient()->getNomcomplet(),
            'meconomie'              => $donnes->getMeconomie(),
            'ranglivret'             => $donnes->getRanglivret(),
            'numordre'               => $donnes->getNumordre(),
            'feuillet'               => $donnes->getFeuillet(),

        ],200);



    }


}
