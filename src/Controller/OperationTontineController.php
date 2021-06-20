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
        $detailtontine = new Detailtontine();
        $form_operation = $this->createForm(OperationTontineType::class, $operation);
        $form_tontine = $this->createForm(FormTontineType::class, $tontine);
        $form_detailtontine = $this->createForm(DetailtontineType::class, $detailtontine);
        $form_operation->handleRequest($request);
        $form_detailtontine->handleRequest($request);

        return $this->render('operation_tontine/index.html.twig', [
            'operation_tontines' => $operationRepository->findAll(),
            'form_operation' => $form_operation->createView(),
            'form_tontine' => $form_tontine->createView(),
            'form_detailtontine' => $form_detailtontine->createView(),
            'operation_tontine' => $operation
        ]);
    }
}
