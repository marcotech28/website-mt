<?php

namespace App\Controller;

use App\Entity\Fournisseur;
use App\Form\FournisseurType;
use App\Repository\CollaborateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\FournisseurRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/crud/fournisseur')]
class AdminCrudFournisseurController extends AbstractController
{
    #[Route('/', name: 'app_fournisseur_index', methods: ['GET'])]
    public function index(FournisseurRepository $fournisseurRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $fournisseurs = $fournisseurRepository->findAll();

        $pagination = $paginator->paginate(
            $fournisseurs,
            $request->query->getInt('page', 1),
            20
        );

        return $this->render('fournisseur/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    /**
     * Route chargée de trier les fournisseurs pour choisir l'ordre d'affichage des fournisseurs
     */
    #[Route('/order-display', name: 'admin_fournisseur_order_display', methods: ['GET'])]
    public function orderDisplay(FournisseurRepository $fournisseurRepository): Response
    {
        // On ne trie que les fournisseurs visibles sur la page
        $fournisseurs = $fournisseurRepository->findAllOrdered();

        return $this->renderForm('fournisseur/manage-order.html.twig', [
            'fournisseurs' => $fournisseurs,
        ]);
    }

    /**
     * Endpoint pour trier l'ordre des fournisseurs dans la page "A propos"
     */
    #[Route('/update-order', name: 'admin_update_order_fournisseur', methods: ['POST'])]
    public function updateOrderFournisseur(Request $request, FournisseurRepository $fournisseurRepository, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['order']) || !is_array($data['order'])) {
            return new JsonResponse(['error' => 'Invalid data'], 400);
        }

        foreach ($data['order'] as $position => $id) {
            $fournisseur = $fournisseurRepository->find($id);
            if ($fournisseur) {
                $fournisseur->setOrderDisplay($position + 1); // +1 pour éviter un ordre à 0
            }
        }

        $em->flush();

        return new JsonResponse(['success' => true]);
    }


    #[Route('/new', name: 'app_fournisseur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, FournisseurRepository $fournisseurRepository): Response
    {
        $fournisseur = new Fournisseur();
        $form = $this->createForm(FournisseurType::class, $fournisseur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // On récupère l'orderDisplay le plus élevé
            $maxOrder = $fournisseurRepository->findMaxOrderDisplay();
            $fournisseur->setOrderDisplay($maxOrder !== null ? $maxOrder + 1 : 1);

            $entityManager->persist($fournisseur);
            $entityManager->flush();

            return $this->redirectToRoute('app_fournisseur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('fournisseur/new.html.twig', [
            'fournisseur' => $fournisseur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_fournisseur_show', methods: ['GET'])]
    public function show(Fournisseur $fournisseur): Response
    {
        return $this->render('fournisseur/show.html.twig', [
            'fournisseur' => $fournisseur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_fournisseur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Fournisseur $fournisseur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FournisseurType::class, $fournisseur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_fournisseur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('fournisseur/edit.html.twig', [
            'fournisseur' => $fournisseur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_fournisseur_delete', methods: ['POST'])]
    public function delete(Request $request, Fournisseur $fournisseur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fournisseur->getId(), $request->request->get('_token'))) {
            $entityManager->remove($fournisseur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_fournisseur_index', [], Response::HTTP_SEE_OTHER);
    }
}
