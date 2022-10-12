<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EspaceProController extends AbstractController
{
    #[Route('/espacepro', name: 'espcepro')]
    public function index(): Response
    {
        return $this->render('espace_pro/espacepro.html.twig', []);
    }
}
