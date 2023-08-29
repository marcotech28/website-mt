<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EspaceProController extends AbstractController
{
    #[Route('/espace-professionnel', name: 'espcepro')]
    #[IsGranted('ROLE_USER')]
    public function index(): Response
    {
        return $this->render('espace_pro/espacepro.html.twig', []);
    }
}
