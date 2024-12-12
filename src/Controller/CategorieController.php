<?php

namespace App\Controller;

use App\Entity\Utilisation;
use App\Repository\CategorieRepository;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategorieController extends AbstractController
{

    #[Route('/{slug}', name: 'app_categorie', priority: -10)]
    public function categorie($slug, CategorieRepository $categorieRepository, ProduitRepository $produitRepository): Response
    {
        $categorie = $categorieRepository->findOneBy([
            'slug' => $slug
        ]);

        if (!$categorie) { //on affiche une erreur si la catégorie n'existe pas
            throw $this->createNotFoundException(("La catégorie demandée n'existe pas"));
        }

        $produits = $produitRepository->findByCategorieAndDraft($categorie);

        return $this->render('categorie/categorie.html.twig', [
            'slug'      => $slug,
            'categorie' => $categorie,
            'produits'  => $produits
        ]);
    }
}
