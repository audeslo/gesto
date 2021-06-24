<?php

namespace App\Controller;

use App\Entity\Agent;
use App\Form\AgentType;
use App\Repository\AgentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/agent")
 */

class AgentController extends AbstractController
{
    /**
     * @Route("/", name="agent_index", methods={"GET"})
     */
    public function index(AgentRepository $agentRepository): Response
    {
        return $this->render('agent/index.html.twig', [
            'agents' => $agentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/nouveau", name="agent_nouveau", methods={"GET","POST"})
     */
    public function new(Request $request, AgentRepository $agentRepository): Response
    {
        $agent = new Agent();
        $form = $this->createForm(AgentType::class, $agent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Récuperer l'iD du dernier agent pour en créer le nouveau
            $refag=getNextIdAgent($agentRepository->findLastAgentId());

            $entityManager = $this->getDoctrine()->getManager();
            $agent->setRefag($refag);
            $entityManager->persist($agent);
            $entityManager->flush();
            $request->getSession()->getFlashBag()->add('success', 'Enregistrement bien effectué.');

            return $this->redirectToRoute('agent_index');
        }

        return $this->render('agent/new.html.twig', [
            'agent' => $agent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="agent_show", methods={"GET"})
     */
    public function show(Agent $agent): Response
    {
        return $this->render('agent/show.html.twig', [
            'agent' => $agent,
        ]);
    }

    /**
     * @Route("/{slug}/modifications", name="agent_modification", methods={"GET","POST"})
     */
    public function edit(Request $request, Agent $agent): Response
    {
        $form = $this->createForm(AgentType::class, $agent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('agent_index');
        }

        return $this->render('agent/edit.html.twig', [
            'agent' => $agent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="agent_delete", methods={"POST"})
     */
    public function delete(Request $request, Agent $agent): Response
    {
        if ($this->isCsrfTokenValid('delete'.$agent->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($agent);
            $entityManager->flush();
        }

        return $this->redirectToRoute('agent_index');
    }

}

function getNextIdAgent($value)
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
