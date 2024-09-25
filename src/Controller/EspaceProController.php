<?php

namespace App\Controller;

use App\Repository\FournisseurRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EspaceProController extends AbstractController
{
    #[Route('/espace-professionnel', name: 'espacepro')]
    #[IsGranted('ROLE_USER')]
    public function index(FournisseurRepository $fournisseurRepository): Response
    {
        $fournisseurs = $fournisseurRepository->findAllWithDocuments();

        return $this->render('espace_pro/espacepro.html.twig', [
            'fournisseurs' => $fournisseurs
        ]);
    }
}
