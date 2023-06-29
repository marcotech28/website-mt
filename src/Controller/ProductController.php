<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    /**
     * @Route("/{category_slug}/{slug}/{id}", name="product_show_no_utilisation", priority=-29)
     * @Route("/{category_slug}/{utilisation_slug}/{slug}/{id}", name="product_show", priority=-30)
     */
    public function show($slug, ProduitRepository $produitRepository): Response
    {
        $product = $produitRepository->findOneBy([
            'slug' => $slug
        ]);

        // dd($product);

        if (!$product) {
            throw $this->createNotFoundException("Le produit demandé n'existe pas");
        }

        return $this->render('product/show.html.twig', [
            'produit' => $product
        ]);
    }

    // #[Route('/products', name: 'product_product')]
    // public function listeProduits(): Response
    // {
    //     return $this->render('product/liste.html.twig');
    // }

}
