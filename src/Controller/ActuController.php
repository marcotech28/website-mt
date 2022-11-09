<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActuController extends AbstractController
{
    #[Route('/actualites', name: 'app_actu')]
    public function index(): Response
    {
        return $this->render('actu/actu.html.twig', [
            'controller_name' => 'ActuController',
        ]);
    }
}
