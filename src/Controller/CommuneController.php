<?php

namespace App\Controller;

use App\Entity\Commune;
use App\Form\CommuneType;
use App\Repository\CommuneRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/administration/commune")
 */
class CommuneController extends AbstractController
{
    /**
     * @Route("/", name="commune_index", methods={"GET"})
     */
    public function index(CommuneRepository $communeRepository,Request $request): Response
    {
        $commune = new Commune();
        $form = $this->createForm(CommuneType::class, $commune);
        $form->handleRequest($request);

        return $this->render('commune/index.html.twig', [
            'communes' => $communeRepository->findAll(),
            'form' => $form->createView(),
            'commune' => $commune
        ]);
    }

    /**
     * @Route("/nouvelle", name="commune_nouvelle", methods={"GET","POST"})
     */
    public function new(Request $request, CommuneRepository $communeRepository): Response
    {
        $commune = new Commune();
        $form = $this->createForm(CommuneType::class, $commune);
        $form->handleRequest($request);

        if ($request->isXmlHttpRequest() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $commune->setCreatedBy($this->getUser());
            $entityManager->persist($commune);
            $entityManager->flush();

            return $this->render('commune/commune_table.html.twig', [
                'communes' => $communeRepository->findAll()
            ]);
        }

        return $this->json(['message' => 'cpas bon'],200);
    }

    /**
     * @Route("/{id}", name="commune_show", methods={"GET"})
     */
    public function show(Commune $commune): Response
    {
        return $this->render('commune/show.html.twig', [
            'commune' => $commune,
        ]);
    }

    /**
     * @Route("/{slug}/modification", name="commune_modification", methods={"GET","POST"})
     */
    public function edit(Request $request, Commune $commune): Response
    {
        $form = $this->createForm(CommuneType::class, $commune);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('commune_index');
        }

        return $this->render('commune/edit.html.twig', [
            'commune' => $commune,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="commune_delete", methods={"POST"})
     */
    public function delete(Request $request, Commune $commune): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commune->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($commune);
            $entityManager->flush();
        }

        return $this->redirectToRoute('commune_index');
    }
}
