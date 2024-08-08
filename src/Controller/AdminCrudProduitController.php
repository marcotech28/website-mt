<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ImageType;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Collections\ArrayCollection;
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

            $entityManager->persist($produit);
            $entityManager->flush();

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
        // On récupère les images actuelles avant de traiter le formulaire
        $originalImages = new ArrayCollection();
        foreach ($produit->getImages() as $image) {
            $originalImages->add($image);
        }

        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Vérifier le nombre d'images
            if (count($produit->getImages()) > 5) {
                $this->addFlash('error', 'Vous ne pouvez pas ajouter plus de 5 images.');
                return $this->redirectToRoute('app_admin_crud_produit_edit', ['id' => $produit->getId()]);
            }

            // Gestion des images
            foreach ($produit->getImages() as $image) {
                if ($image->getProduit() === null) {
                    $image->setProduit($produit);
                }
                $entityManager->persist($image);
            }

            // On supprime les images qui ont été retirées du formulaire
            foreach ($originalImages as $image) {
                if (!$produit->getImages()->contains($image)) {
                    $entityManager->remove($image);
                }
            }

            $entityManager->flush();

            $this->addFlash('success', 'Le produit et ses images ont bien été enregistrés.');

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
}
