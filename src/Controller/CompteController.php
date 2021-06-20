<?php

namespace App\Controller;




use App\Entity\Compte;
use App\Form\CompteType;
use App\Repository\CompteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/compte")
 */
class CompteController extends AbstractController
{
    /**
     * @Route("/", name="compte_index", methods={"GET"})
     */
    public function index(CompteRepository $compteRepository): Response
    {
        return $this->render('compte/index.html.twig', [
            'comptes' => $compteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/nouveau", name="compte_nouveau", methods={"GET","POST"})
     */
    public function new(Request $request, CompteRepository $compteRepository): Response
    {
        $compte = new Compte();
        $form = $this->createForm(CompteType::class, $compte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Récuperer l'iD du dernier compte pour en créer le nouveau
            $numCompte=$form['type']->getData().getNextIdCompte($compteRepository->findLastCompteId());
            $compte->setNumcomp($numCompte);
            //$compte->setCreatedBy($this->getUser());
            //$compte->setAgence($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($compte);
            $entityManager->flush();
            $request->getSession()->getFlashBag()->add('success', 'Enregistrement bien effectué.');

            return $this->redirectToRoute('compte_index');
        }

        return $this->render('compte/new.html.twig', [
            'compte' => $compte,
            'form' => $form->createView(),
        ]);
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
     * @Route("{slug}/modifications", name="compte_modification", methods={"GET","POST"})
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