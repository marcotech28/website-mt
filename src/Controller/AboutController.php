<?php

namespace App\Controller;

use App\Repository\FournisseurRepository;
use App\Repository\CollaborateurRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AboutController extends AbstractController
{
    #[Route('/qui-sommes-nous', name: 'about')]
    public function index(FournisseurRepository $fournisseurRepository, CollaborateurRepository $collaborateurRepository): Response
    {
        $fournisseurs = $fournisseurRepository->findAllOrdered();

        $collaborateurs = $collaborateurRepository->findAllOrdered();

        return $this->render('about/about.html.twig', [
            'fournisseurs' => $fournisseurs,
            'collaborateurs' => $collaborateurs,
        ]);
    }
}
