<?php

namespace App\Controller;

use App\Entity\Detailtontine;
use App\Entity\Operation;
use App\Entity\Tontine;
use App\Form\DetailtontineType;
use App\Form\FormTontineType;
use App\Form\OperationTontineType;
use App\Form\TontineType;
use App\Repository\CompteRepository;
use App\Repository\OperationRepository;
use App\Repository\TontineRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Amp\Iterator\toArray;

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
        $detailTontine = new Detailtontine();

        // Operation
        $form_operation = $this->createForm(OperationTontineType::class, $operation);
        $form_operation->handleRequest($request);

        // Tontine
        $form_tontine = $this->createForm(FormTontineType::class, $tontine);
        $form_tontine->handleRequest($request);

        //DetailTontine
        $form_detail = $this->createForm(DetailtontineType::class, $detailTontine);
        $form_detail->handleRequest($request);

        return $this->render('operation_tontine/index.html.twig', [
            'operation_tontines' => $operationRepository->findAllOperationTontine(),
            'form_operation' => $form_operation->createView(),
            'form_tontine' => $form_tontine->createView(),
            'form_detail' => $form_detail->createView(),
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
        $operation = new Operation();
        $tontine = new Tontine();
        $detailTontine = new Detailtontine();

        $form_operation = $this->createForm(OperationTontineType::class, $operation);
        $form_operation->handleRequest($request);

        $form_tontine = $this->createForm(FormTontineType::class, $tontine);
        $form_tontine->handleRequest($request);

        //DetailTontine
        $form_detail = $this->createForm(DetailtontineType::class, $detailTontine);
        $form_detail->handleRequest($request);

        $donnes=$form_detail['tontine']->getData();

        return $this->json([

            'nomcomplet'             => $donnes->getClient()->getNomcomplet(),
            'meconomie'              => $donnes->getMeconomie(),
            'ranglivret'             => $donnes->getRanglivret(),
            'numordre'               => $donnes->getNumordre(),
            'feuillet'               => $donnes->getFeuillet(),
            'appRestant'             => $donnes->getAppointrest(),

        ],200);

    }

    /**
     * @Route ("/nouvelle", name="operation_tontine_nouvelle", methods={"POST"})
     * @param TontineRepository $tontineRepository
     * @param CompteRepository $compteRepository
     * @param Request $request
     * @return Response
     */
    public function nouvelleOperation(TontineRepository $tontineRepository,
          CompteRepository $compteRepository, Request $request):Response
    {
        // Definition des variable
        $em=$this->getDoctrine()->getManager();
        $operation = new Operation();
        $tontine = new Tontine();
        $detailTontine = new Detailtontine();

        // Idratation des formulaires reçus
        $form_operation = $this->createForm(OperationTontineType::class, $operation);
        $form_operation->handleRequest($request);

        $form_tontine = $this->createForm(FormTontineType::class, $tontine);
        $form_tontine->handleRequest($request);

        $form_detail = $this->createForm(DetailtontineType::class, $detailTontine);
        $form_detail->handleRequest($request);


        // Contrôle pour s'assurer que la requête est ajax et le formulaire est bien soumise
        if($request->isXmlHttpRequest() && $form_operation->isValid()){
            $donneeTontine=$form_detail['tontine']->getData();
            $ref=$donneeTontine->getReflivret();
            // Persist of the operation
            $operation->setAgence(Null);
            $operation->setCompte($donneeTontine->getCompte());
            $operation->setClient($donneeTontine->getClient());
            $operation->setCreatedBy(Null);
            $operation->setDatecomptabilisation(New \DateTime('now'));
            $operation->setLibelleop($ref.' : Encaissement tontine');
            $operation->setValide(false);
            $operation->setSens('C');
            $em->persist($operation);

            //Enregistrement des detailtontine
            $cpt=($operation->getMontantop()/$donneeTontine->getMeconomie()); // Compteur
            //$nbFeuillet=$donneeTontine->getNbfeuillet();
            $appointMax=$donneeTontine->getNbmaxappoint();
            $appointRest=$donneeTontine->getAppointrest();
            $numOrdre=$donneeTontine->getNumOrdre();
            $feuillet=$donneeTontine->getFeuillet();
            for($i=0;  $i<$cpt; $i++){
                $detailTontineCredit = new Detailtontine();
                $appointRest--;
                if($numOrdre==0){ // Debut de feullet (appointement N° 1)
                    $numOrdre++; //Incrementation

                    //Ligne de crédit **********************
                    $detailTontineCredit->setOperation($operation);
                    $detailTontineCredit->setMeconomie($donneeTontine->getMeconomie());
                    $detailTontineCredit->setClient($donneeTontine->getClient());
                    $detailTontineCredit->setDateope($operation->getDateop());
                    $detailTontineCredit->setFeuillet($feuillet);
                    $detailTontineCredit->setMcredit($donneeTontine->getMeconomie());
                    $detailTontineCredit->setNumclt($donneeTontine->getClient()->getNumcli());
                    $detailTontineCredit->setRanglivret($donneeTontine->getRanglivret());
                    $detailTontineCredit->setNumordre($numOrdre);
                    $detailTontineCredit->setTontine($donneeTontine);
                    $em->persist($detailTontineCredit);

                    //Ligne de Débit********************
                            // Persist of the operation
                    $operationDebit = new Operation();
                    $operationDebit->setAgence(Null);
                    $operationDebit->setClient($donneeTontine->getClient());
                    $operationDebit->setMontantop($donneeTontine->getMeconomie());
                    $operationDebit->setCompte($donneeTontine->getCompte());
                    $operationDebit->setCreatedBy(Null);
                    $operationDebit->setNomcomplet('Auto');
                    $operationDebit->setDatecomptabilisation(New \DateTime('now'));
                    $operationDebit->setLibelleop($ref.' : Commissions du Mois');
                    $operationDebit->setValide(false);
                    $operationDebit->setSens('D');
                    $em->persist($operation);
                            // Detail
                    $detailTontineDebit = new Detailtontine();
                    $detailTontineDebit->setOperation($operationDebit);
                    $detailTontineDebit->setMeconomie($donneeTontine->getMeconomie());
                    $detailTontineDebit->setClient($donneeTontine->getClient());
                    $detailTontineDebit->setDateope($operation->getDateop());
                    $detailTontineDebit->setFeuillet($feuillet);
                    $detailTontineDebit->setMcredit($donneeTontine->getMeconomie());
                    $detailTontineDebit->setNumclt($donneeTontine->getClient()->getNumcli());
                    $detailTontineDebit->setRanglivret($donneeTontine->getRanglivret());
                    $detailTontineDebit->setNumordre($numOrdre);
                    $detailTontineDebit->setTontine($donneeTontine);
                    $em->persist($detailTontineDebit);



                }elseif ($numOrdre==$appointMax){ // Fin de feuillet atteint
                    $numOrdre=0;
                    $feuillet++;

                    // Ligne de crédit***********************
                    $detailTontineCredit->setOperation($operation);
                    $detailTontineCredit->setMeconomie($donneeTontine->getMeconomie());
                    $detailTontineCredit->setClient($donneeTontine->getClient());
                    $detailTontineCredit->setDateope($operation->getDateop());
                    $detailTontineCredit->setFeuillet($feuillet);
                    $detailTontineCredit->setMcredit($donneeTontine->getMeconomie());
                    $detailTontineCredit->setNumclt($donneeTontine->getClient()->getNumcli());
                    $detailTontineCredit->setRanglivret($donneeTontine->getRanglivret());
                    $detailTontineCredit->setNumordre($numOrdre);
                    $detailTontineCredit->setTontine($donneeTontine);
                    $em->persist($detailTontineCredit);

                }else{ // Le reste d'appointement, différent du premier et dernier
                    $numOrdre++;

                    // Ligne de crédit
                    $detailTontineCredit->setOperation($operation);
                    $detailTontineCredit->setMeconomie($donneeTontine->getMeconomie());
                    $detailTontineCredit->setClient($donneeTontine->getClient());
                    $detailTontineCredit->setDateope($operation->getDateop());
                    $detailTontineCredit->setFeuillet($feuillet);
                    $detailTontineCredit->setMcredit($donneeTontine->getMeconomie());
                    $detailTontineCredit->setNumclt($donneeTontine->getClient()->getNumcli());
                    $detailTontineCredit->setRanglivret($donneeTontine->getRanglivret());
                    $detailTontineCredit->setNumordre($numOrdre);
                    $detailTontineCredit->setTontine($donneeTontine);
                    $em->persist($detailTontineCredit);
                }

            }
            $donneeTontine->setFeuillet($feuillet);
            $donneeTontine->setNumordre($numOrdre);
            $donneeTontine->setAppointrest($appointRest);
            $em->flush();

            // Mise à jour des compte et Tontine
            $entityManager=$this->getDoctrine()->getManager();
                // Recuperer le l'etat du compte
            $etatTontine=$entityManager->getRepository('App:Detailtontine')
                                ->findEtatCompteTontine($donneeTontine->getId());

                // Mise à jout Tontine
            $entityManager->getRepository('App:Tontine')
                                ->updateSoldeTontine($donneeTontine->getId(),
                                  $etatTontine['soldecli']);

                //Mise à jour Compte
            $entityManager->getRepository('App:Compte')
                ->updateCompte($etatTontine['debit'],$etatTontine['credit'],
                    $etatTontine['soldecli'],$donneeTontine->getCompte()->getId());


            return $this->json([

                'nomcomplet'             => $feuillet,
            ],200);
        }

        return $this->json([
            'message' => 'cpas bien'
        ],200);


    }




}
