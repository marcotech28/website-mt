<?php

namespace App\Controller;

use App\Entity\Utilisation;
use App\Form\UtilisationType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UtilisationRepository;
use Symfony\Component\Form\FormInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



#[Route('/admin/crud/utilisation')]
class AdminCrudUtilisationController extends AbstractController
{
    #[Route('/', name: 'app_admin_crud_utilisation_index', methods: ['GET'])]
    public function index(UtilisationRepository $utilisationRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $utilisations = $utilisationRepository->findAll();

        $pagination = $paginator->paginate(
            $utilisations,
            $request->query->getInt('page', 1),
            20
        );

        return $this->render('admin_crud_utilisation/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    #[Route('/new', name: 'app_admin_crud_utilisation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $utilisation = new Utilisation();
        $form = $this->createForm(UtilisationType::class, $utilisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($utilisation);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_crud_utilisation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_crud_utilisation/new.html.twig', [
            'utilisation' => $utilisation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_crud_utilisation_show', methods: ['GET'])]
    public function show(Utilisation $utilisation): Response
    {
        return $this->render('admin_crud_utilisation/show.html.twig', [
            'utilisation' => $utilisation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_crud_utilisation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Utilisation $utilisation, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UtilisationType::class, $utilisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->flush();

            return $this->redirectToRoute('app_admin_crud_utilisation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_crud_utilisation/edit.html.twig', [
            'utilisation' => $utilisation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_crud_utilisation_delete', methods: ['POST'])]
    public function delete(Request $request, Utilisation $utilisation, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $utilisation->getId(), $request->request->get('_token'))) {
            $entityManager->remove($utilisation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_crud_utilisation_index', [], Response::HTTP_SEE_OTHER);
    }
}
