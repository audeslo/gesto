<?php

namespace App\Controller;

use App\Entity\Pret;

use App\Form\PretType;
use App\Repository\PretRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class PretController
 * @package App\Controller
 * @Route ("/pret")
 */
class PretController extends AbstractController
{
    /**
     * @Route("/", name="pret_index", methods={"GET","POST"})
     */
    public function index(PretRepository $pretRepository,Request $request): Response
    {
        $pret = new Pret();
        $form = $this->createForm(PretType::class, $pret);
        $form->handleRequest($request);

        return $this->render('pret/index.html.twig', [
            'prets' => $pretRepository->findAll(),
            'form' => $form->createView(),
            'pret' => $pret
        ]);
    }

    /**
     * @Route("/nouveau", name="pret_nouveau", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $pret = new Pret();
        $form = $this->createForm(PretType::class, $pret);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            /*$pret->setNumcomp($form['pret']->getData()->getNumcomp());
            $pret->setAppointrest($pret->getNbfeuillet()*$pret->getNbmaxappoint());*/
            $entityManager->persist($pret);
            $entityManager->flush();
            $request->getSession()->getFlashBag()->add('success', 'Enregistrement bien effectué.');

            return $this->redirectToRoute('pret_index');
        }

        return $this->render('pret/new.html.twig', [
            'pret' => $pret,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pret_show", methods={"GET"})
     */
    public function show(Pret $pret): Response
    {
        return $this->render('pret/show.html.twig', [
            'pret' => $pret,
        ]);
    }

    /**
     * @Route("{slug}/modifications", name="pret_modification", methods={"GET","POST"})
     */
    public function edit(Request $request, Pret $pret): Response
    {
        $form = $this->createForm(PretType::class, $pret);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           /* $pret->setAppointrest($pret->getNbfeuillet()
                * $tontine->getNbmaxappoint());*/
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pret_index');
        }

        return $this->render('pret/edit.html.twig', [
            'pret' => $pret,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pret_delete", methods={"POST"})
     */
    public function delete(Request $request, Pret $pret): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pret->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pret);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pret_index');
    }
}
