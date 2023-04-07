<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/crud/categorie')]
class AdminCrudCategorieController extends AbstractController
{
    #[Route('/', name: 'app_admin_crud_categorie_index', methods: ['GET'])]
    public function index(CategorieRepository $categorieRepository): Response
    {
        return $this->render('admin_crud_categorie/index.html.twig', [
            'categories' => $categorieRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_crud_categorie_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $categorie = new Categorie();
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            self::handleImageUpload($categorie, $form, $entityManager);

            $entityManager->persist($categorie);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_crud_categorie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_crud_categorie/new.html.twig', [
            'categorie' => $categorie,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_crud_categorie_show', methods: ['GET'])]
    public function show(Categorie $categorie): Response
    {
        return $this->render('admin_crud_categorie/show.html.twig', [
            'categorie' => $categorie,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_crud_categorie_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Categorie $categorie, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            self::handleImageUpload($categorie, $form, $entityManager);

            $entityManager->flush();

            return $this->redirectToRoute('app_admin_crud_categorie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_crud_categorie/edit.html.twig', [
            'categorie' => $categorie,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_crud_categorie_delete', methods: ['POST'])]
    public function delete(Request $request, Categorie $categorie, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $categorie->getId(), $request->request->get('_token'))) {
            $entityManager->remove($categorie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_crud_categorie_index', [], Response::HTTP_SEE_OTHER);
    }

    public function handleImageUpload(Categorie $categorie, FormInterface $form, EntityManagerInterface $entityManager): void
    {
        $image = $form->get('image')->getData();

        if ($image) {
            // récupération du nom d'origine du fichier + son extension
            $originalImage = pathinfo($image->getClientOriginalName(), PATHINFO_BASENAME);

            // On met à jour l'emplacement de l'image dans l'entité Produit
            $categorie->setImage($originalImage);
        }
    }
}
