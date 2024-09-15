<?php

namespace App\Controller;

use App\Entity\Collaborateur;
use App\Form\CollaborateurType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\CollaborateurRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/crud/collaborateur')]
class CollaborateurController extends AbstractController
{
    #[Route('/', name: 'app_collaborateur_index', methods: ['GET'])]
    public function index(CollaborateurRepository $collaborateurRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $collaborateurs = $collaborateurRepository->findAll();

        $pagination = $paginator->paginate(
            $collaborateurs,
            $request->query->getInt('page', 1),
            20
        );

        return $this->render('collaborateur/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    #[Route('/new', name: 'app_collaborateur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $collaborateur = new Collaborateur();
        $form = $this->createForm(CollaborateurType::class, $collaborateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($collaborateur);
            $entityManager->flush();

            return $this->redirectToRoute('app_collaborateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('collaborateur/new.html.twig', [
            'collaborateur' => $collaborateur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_collaborateur_show', methods: ['GET'])]
    public function show(Collaborateur $collaborateur): Response
    {
        return $this->render('collaborateur/show.html.twig', [
            'collaborateur' => $collaborateur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_collaborateur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Collaborateur $collaborateur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CollaborateurType::class, $collaborateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_collaborateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('collaborateur/edit.html.twig', [
            'collaborateur' => $collaborateur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_collaborateur_delete', methods: ['POST'])]
    public function delete(Request $request, Collaborateur $collaborateur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$collaborateur->getId(), $request->request->get('_token'))) {
            $entityManager->remove($collaborateur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_collaborateur_index', [], Response::HTTP_SEE_OTHER);
    }
}
