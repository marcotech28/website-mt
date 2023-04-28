<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\NewsletterType;
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
    public function homepage(Request $request, MailerInterface $mailer, EntityManagerInterface $em)
    {
        $produitRepository = $em->getRepository(Produit::class);

        $produit1 = $produitRepository->find(23);
        $produit2 = $produitRepository->find(15);
        $produit3 = $produitRepository->find(17);
        $produit4 = $produitRepository->find(18);
        $tableauProduits = array($produit1, $produit2, $produit3, $produit4);

        $form = $this->createForm(NewsletterType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $emailAddress = $form->get('email')->getData();
            $message = (new Email())
                ->from($emailAddress)
                ->to('antonin@marconnet-robotique.com')
                ->subject('Inscription à la newsletter')
                ->text("La personne qui possède l'adresse email {$emailAddress} souhaite s'inscrire à la newsletter");

            $mailer->send($message);

            $this->addFlash('success', "Vous avez bien été inscrit à notre newsletter.");

            return $this->redirectToRoute('homepage');
        }

        return $this->render('home.html.twig', [
            'newsletterForm' => $form->createView(),
            'tabProduits' => $tableauProduits
        ]);
    }
}
