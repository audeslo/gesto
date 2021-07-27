<?php

namespace App\Controller;

use App\Entity\Collecte;
use App\Entity\Operation;
use App\Form\CollecteType;
use App\Form\OperationTontineType;
use App\Repository\CollecteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/operation/collecte")
 *
 */
class CollecteController extends AbstractController
{
    /**
     * @Route("/", name="collecte_index", methods={"GET"})
     */
    public function index(Request $request, CollecteRepository $collecteRepository): Response
    {

        $operation = new Operation();
        $collecte = new Collecte();

        // Operation
        $form_operation = $this->createForm(OperationTontineType::class, $operation);
        $form_operation->handleRequest($request);


        //Collecte
        $form_collecte = $this->createForm(CollecteType::class, $collecte);
        $form_collecte->handleRequest($request);

        return $this->render('collecte/index.html.twig', [
            'collectes' => $collecteRepository->findAllCollecte(),
            'form_operation' => $form_operation->createView(),
            //'form_tontine' => $form_tontine->createView(),
            'form_collecte' => $form_collecte->createView(),
            'collecte' => $operation
        ]);
    }




    /**
     * @Route("/remplirchamp", name="collecte_remplirchamp", methods={"GET","POST"})
     * @param CollecteRepository $tontineRepository
     * @param Request $request
     * @return Response
     */
    public function remplirChamp(CollecteRepository $tontineRepository,Request $request):Response
    {

        $collecte = new Collecte();

        //Collecte
        $form_collecte = $this->createForm(CollecteType::class, $collecte);
        $form_collecte->handleRequest($request);

        $donnes=$form_collecte['tontine']->getData();

        return $this->json([

            'nomcomplet'        => $donnes->getClient()->getNomcomplet(),
            'plafond'           => (($donnes->getNbmaxappoint()-1)*
                    $donnes->getNbfeuillet()*$donnes->getMeconomie())-$donnes->getAvance()

        ],200);

    }


    /**
     * @Route("/nouvel", name="collecte_nouvel", methods={"POST"})
     * @param Request $request
     * @param DataFromDB $dataFromDB
     * @param CollecteRepository $collecteRepository
     * @return JsonResponse|Response
     */
    public function new(Request $request, DataFromDB $dataFromDB,CollecteRepository $collecteRepository)
    {


        $operation = new Operation();
        $collecte = new Collecte();

        // Operation
        $form_operation = $this->createForm(OperationTontineType::class, $operation);
        $form_operation->handleRequest($request);

        //Collecte
        $form_collecte = $this->createForm(CollecteType::class, $collecte);
        $form_collecte->handleRequest($request);

        if($request->isXmlHttpRequest() && $form_operation->isValid())
        {

            // Definition des variable
            $em=$this->getDoctrine()->getManager();
            $devise=$dataFromDB->getDevise();
            $periode=$dataFromDB->getPeriode();

            // Récupération de quelques variables
            $donneeTontine=$form_collecte['tontine']->getData();
            $ref=$donneeTontine->getReflivret();

            // Enregistrement Opération
            $operation->setAgence($this->getUser()->getAgence());
            $operation->setCompte($donneeTontine->getCompte());
            $operation->setClient($donneeTontine->getClient());
            $operation->setDatecomptabilisation(New \DateTime('now'));
            $operation->setLibelleop($ref.' : Collecte sur tontine');
            $operation->setValide(false);
            $operation->setSens('D');
            $operation->setCreatedBy($this->getUser());
            $operation->setPeriode($periode);
            $operation->setDevise($devise);
            $em->persist($operation);

            // Enregistrement de l'collecte
            $collecte=(new Collecte())
                ->setOperation($operation)
                ->setCreatedBy($this->getUser())
                ->setClient($donneeTontine->getClient())
                ->setAgence($this->getUser()->getAgence())
                ->setTontine($donneeTontine)
                ->setDateavan(new \DateTimeImmutable('now'))
                ->setLibelleavan("Collecte sur Tontine")
                ->setMontantavan($operation->getMontantop())
                ->setSoldecomp($donneeTontine->getSolde());
            $em->persist($collecte);

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

            return $this->render('collecte/collecte_table.html.twig', [
                'collectes' => $collecteRepository->findAllCollecte(),
            ]);
        }

        return $this->json([
            'message' => 'cpas bien'
        ],200);

    }

    /**
     * @Route ("/annuler/{slug}", name="collecte_annuler", methods={"GET"})
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

        $collecte=$em->getRepository('App:Collecte')
            ->findOneBy(['operation' =>$operationOld]);

        // Opération contratire de l'collecte
        $newCollecte = new Collecte();
        $newCollecte->setMontantavan($collecte->getMontantavan());
        $newCollecte->setLibelleavan($collecte->getLibelleavan().' Annulée');
        $newCollecte->setDateavan(new \DateTimeImmutable('now'));
        $newCollecte->setTontine($collecte->getTontine());
        $newCollecte->setAgence($this->getUser()->getAgence());
        $newCollecte->setClient($collecte->getClient());
        $newCollecte->setCreatedBy($this->getUser());
        $newCollecte->setOperation($operation);


        // On stock la tontine
        $tontine=$collecte->getTontine();
        $em->persist($newCollecte);

        $em->flush();
        // Mise à jour des compte et Tontine

        // Mettre à jour collecte
        $em->getRepository('App:Tontine')->updateSoldeTontine($tontine->getId(),
            $tontine->getSolde()-$collecte->getMontantavan()
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

        return $this->redirectToRoute('collecte_index');


    }

    /**
     * @Route("/{id}", name="collecte_delete", methods={"POST"})
     */
    public function delete(Request $request, Collecte $collecte): Response
    {
        if ($this->isCsrfTokenValid('delete'.$collecte->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($collecte);
            $entityManager->flush();
        }

        return $this->redirectToRoute('collecte_index', [], Response::HTTP_SEE_OTHER);
    }
}
