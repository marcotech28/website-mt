<?php

namespace App\Controller;

use App\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActuController extends AbstractController
{
    #[Route('/actualites', name: 'app_actu')]
    public function index(NewsRepository $newsRepository): Response
    {

        $listNews = $newsRepository->findAll();

        return $this->render('actu/actu.html.twig', [
            'listNews' => $listNews
        ]);
    }
}
