<?php

namespace App\Controller;


use App\Entity\Tontine;
use App\Form\TontineType;
use App\Repository\TontineRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tontine")
 */
class TontineController extends AbstractController
{
    /**
     * @Route("/", name="tontine_index", methods={"GET"})
     */
    public function index(TontineRepository $tontineRepository): Response
    {
        return $this->render('tontine/index.html.twig', [
            'tontines' => $tontineRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="tontine_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tontine = new Tontine();
        $form = $this->createForm(TontineType::class, $tontine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tontine);
            $entityManager->flush();

            return $this->redirectToRoute('tontine_index');
        }

        return $this->render('tontine/new.html.twig', [
            'tontine' => $tontine,
            'form' => $form->createView(),
        ]);
    }
    /*Quand on enleve le slug ou id ca marche*/
    /**
     * @Route("/id", name="tontine_show", methods={"GET"})
     */
    public function show(Tontine $tontine): Response
    {
        return $this->render('tontine/show.html.twig', [
            'tontine' => $tontine,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="tontine_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Tontine $tontine): Response
    {
        $form = $this->createForm(TontineType::class, $tontine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tontine_index');
        }

        return $this->render('tontine/edit.html.twig', [
            'tontine' => $tontine,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tontine_delete", methods={"POST"})
     */
    public function delete(Request $request, Tontine $tontine): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tontine->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tontine);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tontine_index');
    }
}
