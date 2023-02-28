<?php

namespace App\Controller;

use App\Entity\News;
use App\Form\NewsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NewsController extends AbstractController
{
    #[Route('/admin/news', name: 'app_news')]
    #[Route('/admin/news/{id}/edit', name: 'app_news_edit')]
    public function index(?News $news, Request $request, EntityManagerInterface $entityManager): Response
    {

        if (!$news) {
            $news = new News();
        }

        $form = $this->createForm(NewsType::class, $news);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if (!$news->getId()) {
                $entityManager->persist($news);
            }
            $entityManager->flush();

            return $this->redirect($this->generateUrl('app_news_edit', ['id' => $news->getId()]));
        }

        return $this->render('news/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
