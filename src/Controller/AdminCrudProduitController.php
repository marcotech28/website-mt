<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;


#[Route('/admin/crud/produit')]
class AdminCrudProduitController extends AbstractController
{
    #[Route('/', name: 'app_admin_crud_produit_index', methods: ['GET'])]
    public function index(ProduitRepository $produitRepository): Response
    {
        return $this->render('admin_crud_produit/index.html.twig', [
            'produits' => $produitRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_crud_produit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProduitRepository $produitRepository, EntityManagerInterface $entityManager): Response
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            self::handlePDFUpload($produit, $form, $entityManager);
            self::handleImage1Upload($produit, $form, $entityManager);
            self::handleImage2Upload($produit, $form, $entityManager);
            self::handleImage3Upload($produit, $form, $entityManager);
            self::handleImage4Upload($produit, $form, $entityManager);
            self::handleImage5Upload($produit, $form, $entityManager);

            $entityManager->persist($produit);
            $entityManager->flush();

            // $produitRepository->save($produit, true);

            return $this->redirectToRoute('app_admin_crud_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_crud_produit/new.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_crud_produit_show', methods: ['GET'])]
    public function show(Produit $produit): Response
    {
        return $this->render('admin_crud_produit/show.html.twig', [
            'produit' => $produit,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_crud_produit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Produit $produit, ProduitRepository $produitRepository, EntityManagerInterface $entityManager, ParameterBagInterface $params): Response
    {
        $form = $this->createForm(ProduitType::class, $produit, [
            'image1_filename' => $produit->getImage1(), // ou la méthode que vous utilisez pour obtenir le nom du fichier
            'image2_filename' => $produit->getImage2(), // ou la méthode que vous utilisez pour obtenir le nom du fichier
            'image3_filename' => $produit->getImage3(), // ou la méthode que vous utilisez pour obtenir le nom du fichier
            'image4_filename' => $produit->getImage4(), // ou la méthode que vous utilisez pour obtenir le nom du fichier
            'image5_filename' => $produit->getImage5(), // ou la méthode que vous utilisez pour obtenir le nom du fichier
            'ficheDescriptive_filename' => $produit->getFicheDescriptive(), // ou la méthode que vous utilisez pour obtenir le nom du fichier
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // $produitRepository->save($produit, true);

            // --- fiche descriptive et images du produit --- //

            self::handlePDFUpload($produit, $form, $entityManager);
            self::handleImage1Upload($produit, $form, $entityManager);
            self::handleImage2Upload($produit, $form, $entityManager);
            self::handleImage3Upload($produit, $form, $entityManager);
            self::handleImage4Upload($produit, $form, $entityManager);
            self::handleImage5Upload($produit, $form, $entityManager);

            $entityManager->flush();

            return $this->redirectToRoute('app_admin_crud_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_crud_produit/edit.html.twig', [
            'produit' => $produit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_crud_produit_delete', methods: ['POST'])]
    public function delete(Request $request, Produit $produit, ProduitRepository $produitRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $produit->getId(), $request->request->get('_token'))) {
            $produitRepository->remove($produit, true);
        }

        return $this->redirectToRoute('app_admin_crud_produit_index', [], Response::HTTP_SEE_OTHER);
    }

    //methode image 1

    public function handleImage1Upload(Produit $produit, FormInterface $form, EntityManagerInterface $entityManager): void
    {
        $image = $form->get('image1')->getData();

        if ($image) {
            // récupération du nom d'origine du fichier + son extension
            $originalImage = pathinfo($image->getClientOriginalName(), PATHINFO_BASENAME);

            // On met à jour l'emplacement de l'image dans l'entité Utilisation
            $produit->setImage1($originalImage);

            $entityManager->flush();
        }
    }

    //methode image 2

    public function handleImage2Upload(Produit $produit, FormInterface $form, EntityManagerInterface $entityManager): void
    {
        $image = $form->get('image2')->getData();

        if ($image) {
            // récupération du nom d'origine du fichier + son extension
            $originalImage = pathinfo($image->getClientOriginalName(), PATHINFO_BASENAME);

            // On met à jour l'emplacement de l'image dans l'entité Utilisation
            $produit->setImage2($originalImage);

            $entityManager->flush();
        }
    }

    //methode image 3

    public function handleImage3Upload(Produit $produit, FormInterface $form, EntityManagerInterface $entityManager): void
    {
        $image = $form->get('image3')->getData();

        if ($image) {
            // récupération du nom d'origine du fichier + son extension
            $originalImage = pathinfo($image->getClientOriginalName(), PATHINFO_BASENAME);

            // On met à jour l'emplacement de l'image dans l'entité Utilisation
            $produit->setImage3($originalImage);

            $entityManager->flush();
        }
    }

    //methode image 4

    public function handleImage4Upload(Produit $produit, FormInterface $form, EntityManagerInterface $entityManager): void
    {
        $image = $form->get('image4')->getData();

        if ($image) {
            // récupération du nom d'origine du fichier + son extension
            $originalImage = pathinfo($image->getClientOriginalName(), PATHINFO_BASENAME);

            // On met à jour l'emplacement de l'image dans l'entité Utilisation
            $produit->setImage4($originalImage);

            $entityManager->flush();
        }
    }

    //methode image 5

    public function handleImage5Upload(Produit $produit, FormInterface $form, EntityManagerInterface $entityManager): void
    {
        $image = $form->get('image5')->getData();

        if ($image) {
            // récupération du nom d'origine du fichier + son extension
            $originalImage = pathinfo($image->getClientOriginalName(), PATHINFO_BASENAME);

            // On met à jour l'emplacement de l'image dans l'entité Utilisation
            $produit->setImage5($originalImage);

            $entityManager->flush();
        }
    }

    //methode PDF

    public function handlePDFUpload(Produit $produit, FormInterface $form, EntityManagerInterface $entityManager): void
    {
        // récupération du fichier PDF
        $ficheDescriptiveFile = $form->get('ficheDescriptive')->getData();

        if ($ficheDescriptiveFile) {
            // --- ficheDescriptive --- //

            // récupération du nom d'origine du fichier
            $originalFilename = pathinfo($ficheDescriptiveFile->getClientOriginalName(), PATHINFO_BASENAME);

            // mise à jour de la fiche descriptive du produit
            $produit->setFicheDescriptive($originalFilename);

            $entityManager->flush();
        }
    }
}
