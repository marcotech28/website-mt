<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Repository\ProduitRepository;
use App\Form\SearchForm;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'search')]
    public function search(Request $request, ProduitRepository $produitRepository): Response
    {
        //barre de recherche
        $data = new SearchData();
        $formSearch = $this->createForm(SearchForm::class, $data);
        $formSearch->handleRequest($request);
        $products = $produitRepository->findSearch($data);
        $nbProduitsTotal = $produitRepository->count([]);

        if ($formSearch->isSubmitted() && $formSearch->isValid()) {
            $productsFilter = $produitRepository->findSearch($data);

            return $this->render('search/search.html.twig', [
                'formSearch' => $formSearch->createView(),
                'productsFilter' => $productsFilter,
                'nbProdTotal' => $nbProduitsTotal,
                'searchTerm' => $data->q,  // passez la chaîne de recherche à la vue
            ]);
        }

        // Redirige vers la page précédente si le formulaire n'est pas soumis
        return $this->redirect($request->headers->get('referer'));
    }
}
