<?php

namespace App\Controller;

use App\Entity\Parametre;
use App\Form\ParametreType;
use App\Repository\ParametreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/configuration/parametre")
 */
class ParametreController extends AbstractController
{
    /**
     * @Route("/", name="parametre_index", methods={"GET","POST"})
     */
    public function index(ParametreRepository $parametreRepository, Request $request): Response
    {
        $parametre = new Parametre();
        $form = $this->createForm(ParametreType::class, $parametre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $file = $form->get('file')->getData();
            $parametre->setLogo(file_get_contents($file));
            $parametre->setCreatedBy($this->getUser());

            $entityManager->persist($parametre);
            $entityManager->flush();

            return $this->render('parametre/parametre_table.html.twig', [
                'parametres' => $parametreRepository->findAll()
            ]);
        }

        return $this->render('parametre/index.html.twig', [
            'parametres' => $parametreRepository->findAll(),
            'form' => $form->createView(),
            'parametre' => $parametre,
            //'logo' => base64_encode(stream_get_contents($param->getLogo()))
        ]);
    }

    /**
     * @Route("/nouveau", name="parametre_nouveau", methods={"GET","POST"})
     */
    public function new(Request $request, ParametreRepository $parametreRepository): Response
    {
        $parametre = new Parametre();
        $form = $this->createForm(ParametreType::class, $parametre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $file = $form->get('file')->getData();
            $parametre->setLogo(file_get_contents($file));
            $parametre->setCreatedBy($this->getUser());

            $entityManager->persist($parametre);
            $entityManager->flush();

            return $this->redirectToRoute('parametre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->json(['message' => 'cpas bon'],200);
    }

    /**
     * @Route("/{id}", name="parametre_show", methods={"GET"})
     */
    public function show(Parametre $parametre): Response
    {
        return $this->render('parametre/show.html.twig', [
            'parametre' => $parametre,
        ]);
    }

    /**
     * @Route("/{slug}/modification", name="parametre_modification", methods={"GET","POST"})
     */
    public function edit(Request $request, Parametre $parametre): Response
    {
        $form = $this->createForm(ParametreType::class, $parametre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('parametre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('parametre/edit.html.twig', [
            'parametre' => $parametre,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="parametre_delete", methods={"POST"})
     */
    public function delete(Request $request, Parametre $parametre): Response
    {
        if ($this->isCsrfTokenValid('delete'.$parametre->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($parametre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('parametre_index', [], Response::HTTP_SEE_OTHER);
    }
}
