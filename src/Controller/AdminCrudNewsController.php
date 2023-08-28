<?php

namespace App\Controller;

use App\Entity\News;
// use App\Form\News1Type;
use App\Form\NewsType;
use App\Repository\NewsRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/crud/news')]
class AdminCrudNewsController extends AbstractController
{
    #[Route('/', name: 'app_admin_crud_news_index', methods: ['GET'])]
    public function index(NewsRepository $newsRepository): Response
    {
        return $this->render('admin_crud_news/index.html.twig', [
            'news' => $newsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_crud_news_new', methods: ['GET', 'POST'])]
    public function new(Request $request, NewsRepository $newsRepository, EntityManagerInterface $entityManager): Response
    {
        $news = new News();
        $form = $this->createForm(NewsType::class, $news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newsRepository->save($news, true);

            self::handleImageUpload($news, $form, $entityManager);

            $entityManager->persist($news);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_crud_news_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_crud_news/new.html.twig', [
            'news' => $news,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_crud_news_show', methods: ['GET'])]
    public function show(News $news): Response
    {
        return $this->render('admin_crud_news/show.html.twig', [
            'news' => $news,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_crud_news_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, News $news, NewsRepository $newsRepository, EntityManagerInterface $entityManager): Response
    {

        $form = $this->createForm(NewsType::class, $news, [
            'image_filename' => $news->getImage() // ou la méthode que vous utilisez pour obtenir le nom du fichier
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newsRepository->save($news, true);

            self::handleImageUpload($news, $form, $entityManager);

            $entityManager->persist($news);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_crud_news_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_crud_news/edit.html.twig', [
            'news' => $news,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_crud_news_delete', methods: ['POST'])]
    public function delete(Request $request, News $news, NewsRepository $newsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $news->getId(), $request->request->get('_token'))) {
            $newsRepository->remove($news, true);
        }

        return $this->redirectToRoute('app_admin_crud_news_index', [], Response::HTTP_SEE_OTHER);
    }

    public function handleImageUpload(News $news, FormInterface $form, EntityManagerInterface $entityManager): void
    {
        $image = $form->get('image')->getData();

        if ($image) {
            // récupération du nom d'origine du fichier + son extension
            $originalImage = pathinfo($image->getClientOriginalName(), PATHINFO_BASENAME);

            // On met à jour l'emplacement de l'image dans l'entité Utilisation
            $news->setImage($originalImage);

            $entityManager->flush();
        }
    }
}
