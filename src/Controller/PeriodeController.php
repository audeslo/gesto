<?php

namespace App\Controller;

use App\Entity\Periode;
use App\Form\PeriodeType;
use App\Repository\PeriodeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/configuration/periode")
 */
class PeriodeController extends AbstractController
{
    /**
     * @Route("/", name="periode_index", methods={"GET"})
     */
    public function index(PeriodeRepository $periodeRepository, Request $request): Response
    {
        $periode = new Periode();
        $form = $this->createForm(PeriodeType::class, $periode);
        $form->handleRequest($request);

        $periodeRepository->updatePeriodeClos();

        return $this->render('periode/index.html.twig', [
            'periodes' => $periodeRepository->findAllPeriodes(),
            'form' => $form->createView(),
            'periode' => $periode
        ]);
    }

    /**
     * @Route("/nouvelle", name="periode_new", methods={"GET","POST"})
     */
    public function new(Request $request, PeriodeRepository $periodeRepository): Response
    {
        $periode = new Periode();
        $form = $this->createForm(PeriodeType::class, $periode);
        $form->handleRequest($request);

        if ($request->isXmlHttpRequest() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $annee=$form['annee']->getData();
            $periodes=$entityManager->getRepository('App:Periode')->findBy(
                ['annee' => $annee]
            );

            if(count($periodes) !==0 || $annee<2020 || $annee>2099){
                return $this->json(
                    [
                    'message' => 'L\'exercice (année) '.$form['annee']->getData().
                        ' existe déjà ou incorrecte!',
                     'rapport'=>false
                    ],200);
            }

            // On commence les traitements
            $temoin=$annee.'-01-01';
            $fin=($annee+1).'-01-01';
            $liste=[];
            $debutmois=$temoin;
            $current=$temoin;
            do {
                // on vérifie si le mois à changer
                // si c'est la cas, on enregistre la premiere date et la valeur du "temoin" (derniere date
                //du bouble, qui contient la fin du mois.
                // le nouveau debut sera la date actuelle de la variable current
                if(date('m',strtotime($debutmois)) !== date('m',strtotime($current))){
                    $liste[$debutmois]=$temoin;
                    // On enreigistre les données dans la base de données
                    $periode=(new Periode())
                        ->setCreatedBy($this->getUser())
                        ->setEtat(null)
                        ->setAnnee($annee)
                        ->setCode(date('m',strtotime($debutmois)).'/'.$annee)
                        ->setDebut(new \DateTimeImmutable($debutmois))
                        ->setFin(new \DateTimeImmutable($temoin))
                        ->setValeur((int)$annee.date('m',strtotime($debutmois)))
                        ;
                    $entityManager->persist($periode);
                    $debutmois=$current;
                }
                // incrementations
                $temoin=$current;
                $current=date('Y-m-d',strtotime($temoin.'+ 1 day'));

            }while ($temoin !==$fin);


            //$entityManager->persist($periode);
            $entityManager->flush();

            return $this->render('periode/periode_table.html.twig', [
                'periodes' => $periodeRepository->findAllPeriodes(),
                'rapport'=>true
            ]);
        }

        return $this->json(['message' => 'cpas bon'],200);
    }

    /**
     * @Route("/{slug}", name="periode_modification", methods={"GET"})
     */
    public function show(Periode $periode): Response
    {
        return $this->render('periode/show.html.twig', [
            'periode' => $periode,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="periode_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Periode $periode): Response
    {
        $form = $this->createForm(PeriodeType::class, $periode);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('periode_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('periode/edit.html.twig', [
            'periode' => $periode,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="periode_delete", methods={"POST"})
     */
    public function delete(Request $request, Periode $periode): Response
    {
        if ($this->isCsrfTokenValid('delete'.$periode->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($periode);
            $entityManager->flush();
        }

        return $this->redirectToRoute('periode_index', [], Response::HTTP_SEE_OTHER);
    }
}
