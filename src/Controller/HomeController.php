<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Entity\Produit;
use App\Form\NewsletterType;
use App\Form\SearchForm;
use App\Repository\CompanyRepository;
use App\Repository\ProductGroupRepository;
use App\Repository\ProduitRepository;
use Symfony\Component\Mime\Email;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function homepage(Request $request, MailerInterface $mailer, CompanyRepository $companyRepository, ProduitRepository $produitRepository, ProductGroupRepository $productGroupRepository)
    {
        // Carousel
        $carouselGroup = $productGroupRepository->findOneBy(['libelle' => 'CarouselHomepage']);
        $carouselProduits = $carouselGroup ? $carouselGroup->getProduits() : [];
   
        // Produits préférés
        $favouritesProductsGroup = $productGroupRepository->findOneBy(['libelle' => 'FavouriteProducts']);
        $favouritesProducts = $favouritesProductsGroup ? $favouritesProductsGroup->getProduits() : [];

        // Partenaires
        $etablissementsDeSante = $companyRepository->findBy(['type' => 'Établissement de santé']);
        $prestatairesDeSante = $companyRepository->findBy(['type' => 'Prestataire de santé']);
        
        $form = $this->createForm(NewsletterType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $emailAddress = $form->get('email')->getData();
            $message = (new Email())
                ->from($emailAddress)
                ->to('info@marconnet-robotique.com')
                ->subject('Inscription à la newsletter')
                ->text("La personne qui possède l'adresse email {$emailAddress} souhaite s'inscrire à la newsletter");

            $mailer->send($message);

            $this->addFlash('success', "Vous avez bien été inscrit à notre newsletter.");

            return $this->redirectToRoute('homepage');
        }


        //barre de recherche
        $data = new SearchData();
        $formSearch = $this->createForm(SearchForm::class, $data);
        $formSearch->handleRequest($request);
        $products = $produitRepository->findSearch($data);

        if ($formSearch->isSubmitted() && $formSearch->isValid()) {

            $productsFilter = $produitRepository->findSearch($data);

            return $this->render('search/search.html.twig', [
                'formSearch' => $formSearch->createView(),
                'productsFilter' => $productsFilter,

            ]);
        }

        return $this->render('home.html.twig', [
            'newsletterForm'        => $form->createView(),
            'favouritesProducts'    => $favouritesProducts,
            'products'              => $products,
            'formSearch'            => $formSearch->createView(),
            'carouselProduits'      => $carouselProduits,
            'etablissementsDeSante' => $etablissementsDeSante,
            'prestatairesDeSante'   => $prestatairesDeSante,
        ]);
    }
}
