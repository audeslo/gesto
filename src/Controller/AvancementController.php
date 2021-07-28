<?php

namespace App\Controller;

use App\Entity\Avancement;
use App\Entity\Detailtontine;
use App\Entity\Operation;
use App\Entity\Tontine;
use App\Form\AvancementType;
use App\Form\ResiliationTontineType;
use App\Form\DetailtontineType;
use App\Form\FormTontineType;
use App\Form\OperationTontineType;
use App\Repository\AvancementRepository;
use App\Repository\OperationRepository;
use App\Repository\TontineRepository;
use App\Service\DataFromDB;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AvancementController
 * @package App\Controller
 * @Route ("/operation/avancement")
 */
class AvancementController extends AbstractController
{
    /**
     * @Route("/", name="avancement_index", methods={"GET"})
     */
    public function index(Request $request, AvancementRepository $avancementRepository): Response
    {

        $operation              = new Operation();
        $avancement             = new Avancement();
        $resiliationOperation   = new Operation();
        $resiliation            = new Avancement();

        // Operation
        $form_operation = $this->createForm(OperationTontineType::class, $operation);
        $form_operation->handleRequest($request);


        //Avancement
        $form_avancement = $this->createForm(AvancementType::class, $avancement);
        $form_avancement->handleRequest($request);

        // Resiliation
        $form_resiliation=$this->createForm(ResiliationTontineType::class, $resiliation);
        $form_resiliation->handleRequest($request);

        return $this->render('avancement/index.html.twig', [
            'avancements' => $avancementRepository->findAllAvancement(),
            'form_operation' => $form_operation->createView(),
            'form_resiliationOp' => $form_operation->createView(),
            //'form_tontine' => $form_tontine->createView(),
            'form_avancement' => $form_avancement->createView(),
            'form_resiliation' => $form_resiliation->createView(),
            'avancement' => $operation
        ]);
    }




    /**
     * @Route("/remplirchamp", name="avancement_remplirchamp", methods={"GET","POST"})
     * @param TontineRepository $tontineRepository
     * @param Request $request
     * @return Response
     */
    public function remplirChamp(TontineRepository $tontineRepository,Request $request):Response
    {

        $avancement = new Avancement();

        //Avancement
        $form_avancement = $this->createForm(AvancementType::class, $avancement);
        $form_avancement->handleRequest($request);

        $donnes=$form_avancement['tontine']->getData();

        return $this->json([

            'nomcomplet'        => $donnes->getClient()->getNomcomplet(),
            'plafond'           => (($donnes->getNbmaxappoint()-1)*
                                    $donnes->getNbfeuillet()*$donnes->getMeconomie())-$donnes->getAvance()

        ],200);

    }

    /**
     * @Route("/inforesiliation", name="resiliation_info", methods={"GET","POST"})
     * @param TontineRepository $tontineRepository
     * @param Request $request
     * @return Response
     */
    public function infoResiliation(TontineRepository $tontineRepository,Request $request):Response
    {

        $avancement = new Avancement();

        //Avancement
        $form_avancement = $this->createForm(ResiliationTontineType::class, $avancement);
        $form_avancement->handleRequest($request);

        $donnes=$form_avancement['tontine']->getData();

        return $this->json([

            'nomcomplet'        => $donnes->getClient()->getNomcomplet(),
            'solde'           => $donnes->getSolde()

        ],200);

    }


    /**
     * @Route("/nouvel", name="avancement_nouvel", methods={"POST"})
     * @param Request $request
     * @param DataFromDB $dataFromDB
     * @param AvancementRepository $avancementRepository
     * @return JsonResponse|Response
     */
    public function new(Request $request, DataFromDB $dataFromDB,AvancementRepository $avancementRepository)
    {


        $operation = new Operation();
        $avancement = new Avancement();

        // Operation
        $form_operation = $this->createForm(OperationTontineType::class, $operation);
        $form_operation->handleRequest($request);

        //Avancement
        $form_avancement = $this->createForm(ResiliationTontineType::class, $avancement);
        $form_avancement->handleRequest($request);

        if($request->isXmlHttpRequest() && $form_operation->isValid())
        {

            // Definition des variable
            $em=$this->getDoctrine()->getManager();
            $devise=$dataFromDB->getDevise();
            $periode=$dataFromDB->getPeriode();

            // Récupération de quelques variables
            $donneeTontine=$form_avancement['tontine']->getData();
            $ref=$donneeTontine->getReflivret();

            // Enregistrement Opération
            $operation->setAgence($this->getUser()->getAgence());
            $operation->setCompte($donneeTontine->getCompte());
            $operation->setClient($donneeTontine->getClient());
            $operation->setDatecomptabilisation(New \DateTime('now'));
            $operation->setLibelleop($ref.' : Avancement sur tontine');
            $operation->setValide(false);
            $operation->setSens('D');
            $operation->setCreatedBy($this->getUser());
            $operation->setPeriode($periode);
            $operation->setDevise($devise);
            $em->persist($operation);

                // Enregistrement de l'avancement
                $avancement=(new Avancement())
                    ->setOperation($operation)
                    ->setCreatedBy($this->getUser())
                    ->setClient($donneeTontine->getClient())
                    ->setAgence($this->getUser()->getAgence())
                    ->setTontine($donneeTontine)
                    ->setDateavan(new \DateTimeImmutable('now'))
                    ->setLibelleavan("Avancement sur Tontine")
                    ->setMontantavan($operation->getMontantop())
                    ->setSoldecomp($donneeTontine->getSolde());
                $em->persist($avancement);

                $em->flush();

                // Mise à jour du champ ''avance'' au niveau de tontine
                $em->getRepository('App:Tontine')->updateAvance(
                    $donneeTontine->getId(),
                    ($donneeTontine->getAvance()+$operation->getMontantop())
                );

            // Recuperer le l'etat du compte
            $etatTontine=$em->getRepository('App:Detailtontine')
                ->findEtatCompteTontine($donneeTontine->getId());

            // Mise à jout Tontine
            $em->getRepository('App:Tontine')
                ->updateSoldeTontine($donneeTontine->getId(),
                    $etatTontine['soldecli']);

            //Mise à jour Compte
            $em->getRepository('App:Compte')
                ->updateCompte($etatTontine['debit'],$etatTontine['credit'],
                    $etatTontine['soldecli'],$donneeTontine->getCompte()->getId());

            return $this->render('avancement/avancement_table.html.twig', [
                'avancements' => $avancementRepository->findAllAvancement(),
                ]);
            }

            return $this->json([
                    'message' => 'cpas bien'
                ],200);

    }

    /**
     * @Route ("/annuler/{slug}", name="avancement_annuler", methods={"GET"})
     * @param Operation $operationOld
     * @param Request $request
     * @return Response
     */
    public function annuler(Operation $operationOld, Request $request):Response
    {
        $em=$this->getDoctrine()->getManager();

        // Mettre à jour L'operation à annuler
        $operationOld->setCancel(true);

        $operation=new Operation();
        $tontine=null;
        $operation->setAgence($this->getUser()->getAgence());
        $operation->setCompte($operationOld->getCompte());
        $operation->setClient($operationOld->getClient());
        $operation->setMontantop($operationOld->getMontantop());
        $operation->setDatecomptabilisation(New \DateTime('now'));
        $operation->setLibelleop($operationOld->getLibelleop().' Annulée');
        $operation->setValide(false);
        $operation->setSens('C');
        $operation->setCreatedBy($this->getUser());
        $operation->setPeriode($operationOld->getPeriode());
        $operation->setDevise($operationOld->getDevise());
        $operation->setOperation($operationOld);
        $em->persist($operation);

        $avancement=$em->getRepository('App:Avancement')
            ->findOneBy(['operation' =>$operationOld]);

        // Opération contratire de l'avancement
            $newAvancement = new Avancement();
            $newAvancement->setMontantavan($avancement->getMontantavan());
            $newAvancement->setLibelleavan($avancement->getLibelleavan().' Annulée');
            $newAvancement->setDateavan(new \DateTimeImmutable('now'));
            $newAvancement->setTontine($avancement->getTontine());
            $newAvancement->setAgence($this->getUser()->getAgence());
            $newAvancement->setClient($avancement->getClient());
            $newAvancement->setCreatedBy($this->getUser());
            $newAvancement->setOperation($operation);


            // On stock la tontine
            $tontine=$avancement->getTontine();
            $em->persist($newAvancement);

        $em->flush();
        // Mise à jour des compte et Tontine

        // Mettre à jour avancement
        $em->getRepository('App:Tontine')->updateSoldeTontine($tontine->getId(),
            $tontine->getSolde()-$avancement->getMontantavan()
        );

        // Recuperer le l'etat du compte
        $etatTontine=$em->getRepository('App:Detailtontine')
            ->findEtatCompteTontine($tontine->getId());

        // Mise à jout Tontine
        $em->getRepository('App:Tontine')
            ->updateSoldeTontine($tontine->getId(),
                $etatTontine['soldecli']);

        //Mise à jour Compte
        $em->getRepository('App:Compte')
            ->updateCompte($etatTontine['debit'],$etatTontine['credit'],
                $etatTontine['soldecli'],$tontine->getCompte()->getId());

        $request->getSession()->getFlashBag()->add('success', 'Annulation bien effectuée.');

        return $this->redirectToRoute('avancement_index');


    }


    /**
     * @Route ("/resiliation", name="resiliation_tontine", methods={"POST"})
     * @param Operation $operationOld
     * @param Request $request
     * @return Response
     */
    public function resiliation(Request $request, DataFromDB $dataFromDB):Response
    {
        $em=$this->getDoctrine()->getManager();
        $resiliation            = new Avancement();

        // Resiliation
        $form_resiliation=$this->createForm(ResiliationTontineType::class, $resiliation);
        $form_resiliation->handleRequest($request);

        if($request->isXmlHttpRequest() && $form_resiliation->isSubmitted()){
            $tontine=$form_resiliation['tontine']->getData();

            // Instatiation opération
            $operation=new Operation();
            $operation->setAgence($this->getUser()->getAgence());
            $operation->setCompte($tontine->getCompte());
            $operation->setClient($tontine->getClient());
            $operation->setMontantop($form_resiliation['temoinsolde']->getData());
            $operation->setDatecomptabilisation(New \DateTime('now'));
            $operation->setLibelleop($tontine->getReflivret().'Fermeture');
            $operation->setValide(false);
            $operation->setSens('D');
            $operation->setCreatedBy($this->getUser());
            $operation->setPeriode($dataFromDB->getPeriode());
            $operation->setDevise($dataFromDB->getDevise());
            $em->persist($operation);

            // Opération contratire de l'avancement
            $newAvancement = new Avancement();
            $newAvancement->setMontantavan($form_resiliation['temoinsolde']->getData());
            $newAvancement->setLibelleavan($tontine->getReflivret().'Fermeture');
            $newAvancement->setDateavan(new \DateTimeImmutable('now'));
            $newAvancement->setTontine($tontine);
            $newAvancement->setAgence($this->getUser()->getAgence());
            $newAvancement->setClient($tontine->getClient());
            $newAvancement->setCreatedBy($this->getUser());
            $newAvancement->setOperation($operation);
            $newAvancement->setResilier(true);
            $newAvancement->setSoldecomp(0);
            $em->persist($newAvancement);

            $em->flush();
            // Mise à jour des compte et Tontine

            // Mettre à jour Tontine
            $em->getRepository('App:Tontine')->clotureTontine($tontine->getId(),
                $form_resiliation['temoinsolde']->getData());

            // Recuperer le l'etat du compte
            $etatTontine=$em->getRepository('App:Detailtontine')
                ->findEtatCompteTontine($tontine->getId());


            //Mise à jour Compte
            $em->getRepository('App:Compte')
                ->updateCompte(($etatTontine['debit']),
                    $etatTontine['credit'],
                    $etatTontine['soldecli'],$tontine->getCompte()->getId());

            $request->getSession()->getFlashBag()->add('success', 'Fermeture bien effectuée.');

            return $this-> json([
                'message'   => 'Cbon !'
            ], 200);
            //return $this->redirectToRoute('avancement_index');
        }

        return $this->json([
            'message'   => 'Cpas bon'
        ], 200);


    }

}
