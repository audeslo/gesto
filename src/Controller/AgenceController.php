<?php

namespace App\Controller;

use App\Entity\Agence;
use App\Form\AgenceType;
use App\Repository\AgenceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/administration/agence")
 */
class AgenceController extends AbstractController
{
    /**
     * @Route("/", name="agence_index", methods={"GET"})
     */
    public function index(AgenceRepository $agenceRepository,Request $request): Response
    {
        $agence = new Agence();
        $form = $this->createForm(AgenceType::class, $agence);
        $form->handleRequest($request);

        return $this->render('agence/index.html.twig', [
            'agences' => $agenceRepository->findAll(),
            'form' => $form->createView(),
            'agence' => $agence
        ]);
    }

    /**
     * @Route("/nouveau", name="agence_nouveau", methods={"GET","POST"})
     */
    public function new(Request $request,AgenceRepository $agenceRepository): Response
    {
        $agence = new Agence();
        $form = $this->createForm(AgenceType::class, $agence);
        $form->handleRequest($request);

        if ($request->isXmlHttpRequest() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $agence->setCreatedBy($this->getUser());
            $entityManager->persist($agence);
            $entityManager->flush();

            return $this->render('agence/agence_table.html.twig', [
                'agences' => $agenceRepository->findAll()
            ]);
        }

        return $this->json(['message' => 'cpas bon'],200);
    }

    /**
     * @Route("/{id}", name="agence_show", methods={"GET"})
     */
    public function show(Agence $agence): Response
    {
        return $this->render('agence/show.html.twig', [
            'agence' => $agence,
        ]);
    }

    /**
     * @Route("/{slug}/modification", name="agence_modification", methods={"GET","POST"})
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
