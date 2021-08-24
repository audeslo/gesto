<?php

namespace App\Controller;

use App\Repository\DetailtontineRepository;
use App\Repository\OperationRepository;
use App\Repository\ParametreRepository;
use App\Repository\PeriodeRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Dompdf\Dompdf;
use Dompdf\Options;
use jonasarts\Bundle\TCPDFBundle\TCPDF\TCPDF;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\DataFromDB;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="Accueil")
     */
    public function index(): Response
    {


        return $this->render('base.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("/session_user", name="session_user")
     */
    public function session(): Response
    {
        // Récupérer des information juste à l'ouverture de la session

        $em = $this->getDoctrine()->getManager();
        $ip = $_SERVER['REMOTE_ADDR'];
        $em->getRepository('App:User')->upDatelastLogin($this->getUser()->getId(), $ip);


        return $this->render('base.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("/test", name="test")
     */
    public function test(OperationRepository $operationRepository,TCPDF $pdf): Response
    {
       /* $all=$operationRepository->allSt();
        $solde=0;
        foreach ($all as $item){
            if($item->getSens() ==='D'){
                $solde-=$item->getMontantop();
            }else{
                $solde+=$item->getMontantop();
            }
            $operationRepository->updateSolde($item->getId(),$solde);
            $solde=$item->getMontantop();
        }*/
        //dd($operationRepository->findAllAppointement(4));

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('');
        $pdf->SetTitle('Listing');
        $pdf->SetSubject('Police ');
        $pdf->SetKeywords('Listing, ' . 1);

        // remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);


        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        //$pdf->SetMargins(4, 0, 2); //Attestation jaune
        $pdf->SetMargins(8, 10, 8);
        // set automobile page breaks
        $pdf->SetAutoPageBreak(false, PDF_MARGIN_BOTTOM);

        // set font
        $pdf->SetFont('times', '', 12);


        // set page format (read source code documentation for further information)
        $page_format = array(
            'MediaBox' => array('llx' => 0, 'lly' => 0, 'urx' => 297, 'ury' => 210),
            'CropBox' => array('llx' => 0, 'lly' => 0, 'urx' => 297, 'ury' => 210),
            'BleedBox' => array('llx' => 5, 'lly' => 5, 'urx' => 297, 'ury' => 210),
            'TrimBox' => array('llx' => 10, 'lly' => 10, 'urx' => 297, 'ury' => 210),
            'ArtBox' => array('llx' => 15, 'lly' => 15, 'urx' => 297, 'ury' => 210),
            'Dur' => 3,
            'trans' => array(
                'D' => 1.5,
                'S' => 'Split',
                'Dm' => 'V',
                'M' => 'O'
            ),
            'Rotate' => 0,
            'PZ' => 1,
        );

        // Check the example n. 29 for viewer preferences

        // add first page ---
        $pdf->AddPage('L', $page_format, false, false);
        //$pdf->Cell(0, 0, '', 1, 1, 'C');


        //$pdf->AddPage();

        $param = $this->getDoctrine()->getManager()
            ->getRepository('App:Parametre')->findOneBy(['actif' => true]);


        $html = $this->renderView('etat/appointement.html.twig', [
            'operationTontines' => $operationRepository->findAllAppointement(null)
        ]);
        // }


        /* $html = $this->renderView('automobile/attestationcedeao.html.twig', [
             'title' => 'Welcome to our PDF Test'
         ]);*/

        // set some text to print
        /*$txt = <<<EOD
 TCPDF Example 002

 Default page header and footer are disabled using setPrintHeader() and setPrintFooter() methods.
 EOD;*/

        // print a block of text using Write()
        //$pdf->Write(0, $txt, '', 0, '', true, 0, false, false, 0);
        $pdf->writeHTML($html, true, false, true, false, '');

        $pdf->Output('Carte Jaune Police ' . 'ze' . '.pdf', 'I');

    }
}
