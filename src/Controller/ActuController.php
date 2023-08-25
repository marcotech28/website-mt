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
        $listNews = $newsRepository->findBy([], ['date' => 'DESC']); // Tri par date décroissante

        return $this->render('actu/actu.html.twig', [
            'listNews' => $listNews
        ]);
    }

    #[Route('/actualites/{titreSlug}/{id}', name: 'app_actu_show')]
    public function show(NewsRepository $newsRepository, $id, $titreSlug): Response
    {

        $news = $newsRepository->findOneBy([
            'id' => $id,
            'titreSlug' => $titreSlug
        ]);

        return $this->render('actu/show.html.twig', [
            'news' => $news
        ]);
    }
}
