<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController
{
    #[Route('/qui-sommes-nous', name: 'about')]
    public function index(): Response
    {
        return $this->render('about/about.html.twig', []);
    }
}
