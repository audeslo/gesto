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
use App\Repository\DetailtontineRepository;
use App\Repository\OperationRepository;
use App\Repository\TontineRepository;
use App\Service\DataFromDB;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Amp\Iterator\toArray;

/**
 * Class AppointementController
 * @package App\Controller
 * @Route("/operation/appointement")
 */
class AppointementController extends AbstractController
{

    /**
     * @Route("/", name="appointement_index", methods={"GET","POST"})
     */
    public function index(DetailtontineRepository $detailtontineRepository, Request $request): Response
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

        return $this->render('appointement/index.html.twig', [
            'appointements' => $detailtontineRepository->findAllDetailOperation(),
            'form_operation' => $form_operation->createView(),
            'form_tontine' => $form_tontine->createView(),
            'form_detail' => $form_detail->createView(),
            'appointement' => $operation
        ]);
    }

    /**
     * @Route("/remplirchamp", name="appointement_remplirchamp", methods={"GET","POST"})
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
     * @Route ("/nouvel", name="appointement_nouvelle", methods={"POST"})
     * @param Request $request
     * @param OperationRepository $operationRepository
     * @return Response
     */
    public function nouvelleOperation(Request $request, DetailtontineRepository $detailtontineRepository,
    DataFromDB $dataFromDB
    ):Response
    {
        // Definition des variable
        $em=$this->getDoctrine()->getManager();
        $devise=$dataFromDB->getDevise();
        $periode=$dataFromDB->getPeriode();

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
            $operation->setAgence($this->getUser()->getAgence());
            $operation->setCompte($donneeTontine->getCompte());
            $operation->setClient($donneeTontine->getClient());
            $operation->setDatecomptabilisation(New \DateTime('now'));
            $operation->setLibelleop($ref.' : Encaissement tontine');
            $operation->setValide(false);
            $operation->setSens('C');
            $operation->setCreatedBy($this->getUser());
            $operation->setPeriode($periode);
            $operation->setDevise($devise);
            $em->persist($operation);

            //Enregistrement des detailtontines
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
                    $detailTontineCredit->setCreatedBy($this->getUser());
                    $em->persist($detailTontineCredit);

                    //Ligne de Débit********************
                            // Persist of the operation
                    $operationDebit = new Operation();
                    $operationDebit->setAgence($this->getUser()->getAgence());
                    $operationDebit->setClient($donneeTontine->getClient());
                    $operationDebit->setMontantop($donneeTontine->getMeconomie());
                    $operationDebit->setCompte($donneeTontine->getCompte());
                    $operationDebit->setCreatedBy($this->getUser());
                    $operationDebit->setNomcomplet('Auto');
                    $operationDebit->setDatecomptabilisation(New \DateTime('now'));
                    $operationDebit->setLibelleop($ref.' : Commissions du Mois');
                    $operationDebit->setValide(false);
                    $operationDebit->setSens('D');
                    $operationDebit->setCreatedBy($this->getUser());
                    $operationDebit->setPeriode($periode);
                    $operationDebit->setDevise($devise);
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
                    $detailTontineDebit->setCreatedBy($this->getUser());
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
                    $detailTontineCredit->setCreatedBy($this->getUser());
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
                    $detailTontineCredit->setCreatedBy($this->getUser());
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



            return $this->render('appointement/appointement_table.html.twig', [
                'appointements' => $detailtontineRepository->findAllDetailOperation(),
            ]);
        }

        return $this->json([
            'message' => 'cpas bien'
        ],200);


    }


    /**
     * @Route ("/annuler/{slug}", name="appointement_annuler", methods={"GET"})
     * @return Response
     */
    public function annuler(Operation $operationOld, Request $request):Response
    {
        // Mettre à jour L'operation à annuler
        $operationOld->setCancel(true);

        $em=$this->getDoctrine()->getManager();
        $operation=new Operation();
        $tontine=null;
        $operation->setAgence($this->getUser()->getAgence());
        $operation->setCompte($operationOld->getCompte());
        $operation->setClient($operationOld->getClient());
        $operation->setMontantop($operationOld->getMontantop());
        $operation->setDatecomptabilisation(New \DateTime('now'));
        $operation->setLibelleop($operationOld->getLibelleop().' Annulée');
        $operation->setValide(false);
        $operation->setSens('D');
        $operation->setCreatedBy($this->getUser());
        $operation->setPeriode($operationOld->getPeriode());
        $operation->setDevise($operationOld->getDevise());
        $operation->setOperation($operationOld);
        $em->persist($operation);

            $details=$em->getRepository('App:Detailtontine')
                        ->findBy(['operation' =>$operationOld]);

            foreach ($details as $detail)
            {
                $detailTontineDebit = new Detailtontine();
                $detailTontineDebit->setOperation($detail->getOperation());
                $detailTontineDebit->setMeconomie($detail->getMeconomie());
                $detailTontineDebit->setClient($detail->getClient());
                $detailTontineDebit->setDateope($operation->getDateop());
                $detailTontineDebit->setFeuillet($detail->getFeuillet());
                $detailTontineDebit->setMcredit($detail->getMeconomie());
                $detailTontineDebit->setNumclt($detail->getClient()->getNumcli());
                $detailTontineDebit->setRanglivret($detail->getRanglivret());
                $detailTontineDebit->setNumordre($detail->getNumordre());
                $detailTontineDebit->setTontine($detail->getTontine());
                $detailTontineDebit->setOperation($operation);
                $detailTontineDebit->setCreatedBy($this->getUser());

                // On stock la tontine
                $tontine=$detail->getTontine();
                $em->persist($detailTontineDebit);
            }

            $em->flush();
        // Mise à jour des compte et Tontine
        $entityManager=$this->getDoctrine()->getManager();

            // Mettre à jour le nombre d'appointement restant
            $entityManager->getRepository('App:Tontine')->updateNbAppointement($tontine->getId(),
            $tontine->getAppointrest()+count($details)
            );

        // Recuperer le l'etat du compte
        $etatTontine=$entityManager->getRepository('App:Detailtontine')
            ->findEtatCompteTontine($tontine->getId());

        // Mise à jout Tontine
        $entityManager->getRepository('App:Tontine')
            ->updateSoldeTontine($tontine->getId(),
                $etatTontine['soldecli']);

        //Mise à jour Compte
        $entityManager->getRepository('App:Compte')
            ->updateCompte($etatTontine['debit'],$etatTontine['credit'],
                $etatTontine['soldecli'],$tontine->getCompte()->getId());

        $request->getSession()->getFlashBag()->add('success', 'Annulation bien effectuée.');

            return $this->redirectToRoute('appointement_index');


    }



}
