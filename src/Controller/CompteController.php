<?php

namespace App\Controller;




use App\Entity\Compte;
use App\Entity\Tontine;
use App\Form\CompteType;
use App\Repository\CompteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/traitement/compte")
 */
class CompteController extends AbstractController
{
    /**
     * @Route("/", name="compte_index", methods={"GET"})
     */
    public function index(CompteRepository $compteRepository,Request $request): Response
    {
        $compte = new Compte();
        $form = $this->createForm(CompteType::class, $compte);
        $form->handleRequest($request);

        return $this->render('compte/index.html.twig', [
            'comptes' => $compteRepository->findAll(),
            'form' => $form->createView(),
            'compte' => $compte
        ]);
    }

    /**
     * @Route("/nouveau", name="compte_nouveau", methods={"POST"})
     */
    public function new(Request $request, CompteRepository $compteRepository): Response
    {
        $compte = new Compte();
        $form = $this->createForm(CompteType::class, $compte);
        $form->handleRequest($request);

        if ($request->isXmlHttpRequest() && $form->isValid()) {
            // Récuperer l'iD du dernier compte pour en créer le nouveau
            $numCompte=$form['type']->getData().getNextIdCompte($compteRepository->findLastCompteId());
            $compte->setNumcomp($numCompte);
            $compte->setCreatedBy($this->getUser());
            $compte->setAgence($this->getUser()->getAgence());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($compte);

            // On enregistre le type lié
                switch ($compte->getType()) {
                    case '01':
                        $tontine=new Tontine();
                        $tontine->setCompte($compte);
                        $tontine->setRanglivret(1);
                        $tontine->setClient($compte->getClient());
                        $tontine->setAgence($this->getUser()->getAgence());
                        $tontine->setDateinscr(new \DateTimeImmutable('now'));
                        $tontine->setNumcomp($compte->getNumcomp());
                        $tontine->setCreatedBy($this->getUser());
                        $tontine->setNiveau('draft');
                        $tontine->setReflivret('');
                        $entityManager->persist($tontine);
                        break;

                }


            $entityManager->flush();
            return $this->render('compte/compte_table.html.twig', [
                'comptes' => $compteRepository->findAll()
            ]);
        }

        return $this->json(['message' => 'cpas bon'],200);
    }

    /**
     * @Route("/{id}", name="compte_show", methods={"GET"})
     */
    public function show(Compte $compte): Response
    {
        return $this->render('compte/show.html.twig', [
            'compte' => $compte,
        ]);
    }

    /**
     * @Route("{slug}/modifications", name="compte_modification", methods={"POST","GET"})
     */
    public function edit(Request $request, Compte $compte): Response
    {
        $form = $this->createForm(CompteType::class, $compte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('compte_index');
        }

        return $this->render('compte/edit.html.twig', [
            'compte' => $compte,
            'donnee_type' => $compte->getType(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="compte_delete", methods={"POST"})
     */
    public function delete(Request $request, Compte $compte): Response
    {
        if ($this->isCsrfTokenValid('delete'.$compte->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($compte);
            $entityManager->flush();
        }

        return $this->redirectToRoute('compte_index');
    }
}

function getNextIdCompte($value)
{
    $autom = (int) $value;
    $autom++;

    if ($autom<10) {
        return '0000'.$autom;
    }

    if ($autom<100) {
        return '000'.$autom;
    }

    if ($autom<1000) {
        return '00'.$autom;
    }

    if($autom<10000) {
        return '0'.$autom;
    }

    return $autom;
}