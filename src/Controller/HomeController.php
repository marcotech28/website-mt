<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Data\SearchData;
use App\Form\SearchForm;
use App\Entity\Newsletter;
use App\Form\NewsletterType;
use Symfony\Component\Mime\Email;
use App\Repository\CompanyRepository;
use App\Repository\NewsletterRepository;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ProductGroupRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function homepage(
        Request $request, 
        MailerInterface $mailer, 
        CompanyRepository $companyRepository, 
        ProduitRepository $produitRepository, 
        ProductGroupRepository $productGroupRepository,
        EntityManagerInterface $em,
        NewsletterRepository $newsletterRepository)
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
        
        $newsletter = new Newsletter();
        $form = $this->createForm(NewsletterType::class, $newsletter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Vérifie si l'email existe déjà en base
            $existingSubscriber = $newsletterRepository->findOneBy(['email' => $newsletter->getEmail()]);

            if ($existingSubscriber) {
                $this->addFlash('error', 'Cet email est déjà inscrit à notre newsletter.');
                return $this->redirectToRoute('homepage');
            }

            $newsletter->setCreatedAt(new \DateTime());

            $em->persist($newsletter);
            $em->flush();

            $confirmationEmail = (new Email())
                ->from('info@marconnet-robotique.com')
                ->to('info@marconnet-robotique.com')
                ->subject('Inscription à la newsletter')
                ->text('La personne qui possède l\'adresse email ' . $newsletter->getEmail() . ' souhaite s\'inscrire à la newsletter');

            $mailer->send($confirmationEmail);

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
