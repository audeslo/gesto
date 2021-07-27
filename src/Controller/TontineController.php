<?php

namespace App\Controller;


use App\Entity\Tontine;
use App\Form\CompteType;
use App\Form\TontineType;
use App\Repository\TontineRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TontineController
 * @package App\Controller
 * @Route ("/operations/tontine")
 */
class TontineController extends AbstractController
{
    /**
     * @Route("/", name="tontine_index", methods={"GET","POST"})
     */
    public function index(TontineRepository $tontineRepository,Request $request): Response
    {
        $tontine = new Tontine();
        $form = $this->createForm(TontineType::class, $tontine);
        $form->handleRequest($request);

        return $this->render('tontine/index.html.twig', [
            'tontines' => $tontineRepository->findAll(),
            'form' => $form->createView(),
            'tontine' => $tontine
        ]);
    }

    /**
     * @Route("/nouveau", name="tontine_nouveau", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tontine = new Tontine();
        $form = $this->createForm(TontineType::class, $tontine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $tontine->setNumcomp($form['compte']->getData()->getNumcomp());
            $tontine->setAppointrest($tontine->getNbfeuillet()*$tontine->getNbmaxappoint());
            $entityManager->persist($tontine);
            $entityManager->flush();
            $request->getSession()->getFlashBag()->add('success', 'Enregistrement bien effectué.');

            return $this->redirectToRoute('tontine_index');
        }



        return $this->render('tontine/new.html.twig', [
            'tontine' => $tontine,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tontine_show", methods={"GET"})
     */
    public function show(Tontine $tontine): Response
    {
        return $this->render('tontine/show.html.twig', [
            'tontine' => $tontine,
        ]);
    }

    /**
     * @Route("{slug}/modifications", name="tontine_modification", methods={"GET","POST"})
     */
    public function edit(Request $request, Tontine $tontine): Response
    {
        $form = $this->createForm(TontineType::class, $tontine);
        $form->handleRequest($request);
        $solde=$tontine->getSolde();
        if ($form->isSubmitted() && $form->isValid()) {
            // enleve la tontine de brouillon
            if ($tontine->getNiveau()==='draft') {
                $tontine->setNiveau('progress');
                // Enregistrer le solde restant
                $tontine->setAppointrest($tontine->getNbfeuillet()*$tontine->getNbmaxappoint());
            }
            $tontine->setAppointrest($tontine->getNbfeuillet()
                *$tontine->getNbmaxappoint());
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tontine_index');
        }

        return $this->render('tontine/edit.html.twig', [
            'tontine' => $tontine,
            'form' => $form->createView(),
            'solde'=>1
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
