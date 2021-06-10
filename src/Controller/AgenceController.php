<?php

namespace App\Controller;

use App\Entity\Agence;
use App\Entity\Client;
use App\Form\AgenceType;
use App\Form\ClientType;
use App\Repository\AgenceRepository;
use App\Repository\ClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


//*
// * @Route("/agence")
//
class AgenceController extends AbstractController
{
    /**
     * @Route("/", name="agence_index", methods={"GET"})
     */
    public function index(AgenceRepository $agenceRepository): Response
    {
        return $this->render('agence/index.html.twig', [
            'agences' => $agenceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="agence_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $agence = new Agence();
        $form = $this->createForm(AgenceType::class, $agence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($agence);
            $entityManager->flush();


            $lastid=$entityManager->getRepository('App:Agence')->findLastId();

            $entityManager->getRepository('App:Agence')->updateLastReferent($lastid,'AG-'.getIncrementation($lastid));

            $request->getSession()->getFlashBag()->add('success', 'Enregistrement bien effectué.');
            return $this->redirectToRoute('agence_index');
        }

        return $this->render('agence/new.html.twig', [
            'agence' => $agence,
            'form' => $form->createView(),
        ]);
    }
/*Quand on enleve le slug ou id ca marche*/
   /**
  * @Route("/", name="agence_show", methods={"GET"})
     */
    public function show(Agence $agence): Response
    {
        return $this->render('agence/show.html.twig', [
            'agence' => $agence,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="agence_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Agence $agence): Response
    {
        $form = $this->createForm(AgenceType::class, $agence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('agence_index');
        }

        return $this->render('agence/edit.html.twig', [
            'agence' => $agence,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="agence_delete", methods={"POST"})
     */
    public function delete(Request $request, Agence $agence): Response
    {
        if ($this->isCsrfTokenValid('delete'.$agence->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($agence);
            $entityManager->flush();
        }

        return $this->redirectToRoute('agence_index');
    }
}

function getIncrementation(int $auto)
{

    if($auto<10)
    {
        return '0000'.$auto;
    }elseif ($auto<100)
    {
        return '000'.$auto;
    }elseif ($auto<1000)
    {
        return '00'.$auto;
    }elseif ($auto<10000)
    {
        return '0'.$auto;
    }else{
        return $auto;
    }
}