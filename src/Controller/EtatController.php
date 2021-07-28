<?php

namespace App\Controller;

use App\Form\EtatTontineType;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/etat")
 */
class EtatController extends AbstractController
{
    /**
     * @Route("/tontine", name="etat_tontine")
     */
    public function tontine(Request $request): Response
    {

        $form = $this->createForm(EtatTontineType::class);
        $form->handleRequest($request);

        if($request->isXmlHttpRequest() && $form->isSubmitted())
        {
            $em=$this->getDoctrine()->getManager();
            // Configure Dompdf according to your needs
            $pdfOptions = new Options();
            $pdfOptions->set('defaultFont', 'Arial');
            $pdfOptions->set('isRemoteEnabled', TRUE);
            // Instantiate Dompdf with our options
            $dompdf = new Dompdf($pdfOptions);

            //Préparation des données
            if(! $form['tontine']->getData())
            {
                switch ($_POST['intervalle']){
                    case '01':

                    break;
                }
            }else{

            }

            // Préparation du PDF
            $html = $this->renderView('voyage/'.null, [
                'contrat' => null,
                'listeGaranties' =>null ,
                /*'dateEdit' => $contrat->getDatecontrat(),*/
                'logo' => base64_encode(stream_get_contents($param->getLogo())),
                'devise' => $param->getDevise(),
            ]);

            // Load HTML to Dompdf
            $dompdf->loadHtml($html);
            $dompdf->add_info('nom','Fichier');

            // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
            $dompdf->setPaper('A4', 'portrait');

            // Render the HTML as PDF
            $dompdf->render();

            // Output the generated PDF to Browser (force download)
            $dompdf->stream($contrat->getHash().'.pdf', [
                'Attachment' => false
            ]);


        }

        return $this->render('etat/tontine.html.twig', [
            'controller_name' => 'EtatController',
            'form'      => $form->createView(),
        ]);
    }
}
