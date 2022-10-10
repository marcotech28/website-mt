<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PartenaireController extends AbstractController
{
    #[Route('/partenaires', name: 'partenaires')]
    public function index(): Response
    {
        return $this->render('partenaire/partenaires.html.twig', []);
    }
}
