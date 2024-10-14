<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LegalController extends AbstractController
{
    #[Route('/mentions-legales', name: 'mentions-legales')]
    public function index(): Response
    {
        return $this->render('legal/mentions-legales.html.twig', []);
    }

    #[Route('/cookies', name: 'cookies')]
    public function cookies(): Response
    {
        return $this->render('legal/cookies.html.twig', []);
    }
}
