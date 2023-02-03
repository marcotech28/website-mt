<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Repository\ProduitRepository;
use App\Repository\UtilisationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UtilisationController extends AbstractController
{
    /**
     * @Route("/{category_slug}/{utilisation_slug}/", name="app_utilisation")
     */
    public function index($category_slug, $utilisation_slug, CategorieRepository $categorieRepository, UtilisationRepository $utilisationRepository): Response
    {

        $categorie = $categorieRepository->findOneBy([
            'slug' => $category_slug
        ]);

        $utilisation = $utilisationRepository->findOneBy([
            'slug' => $utilisation_slug
        ]);

        if (!$categorie) { //on affiche une erreur si la catégorie n'existe pas
            throw $this->createNotFoundException(("La catégorie demandée n'existe pas"));
        }

        if (!$utilisation) { //on affiche une erreur si l'utilisation n'existe pas
            throw $this->createNotFoundException(("L'utilisation demandée n'existe pas"));
        }

        return $this->render('utilisation/index.html.twig', [
            'categorie' => $categorie,
            'utilisation' => $utilisation,
            'utilisation_slug' => $utilisation_slug,
            'categorie_slug' => $category_slug
        ]);
    }
}
