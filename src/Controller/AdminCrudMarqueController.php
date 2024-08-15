<?php

namespace App\Controller;

use App\Entity\Marque;
use App\Form\MarqueType;
use App\Repository\MarqueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/admin/crud/marque')]
class AdminCrudMarqueController extends AbstractController
{
    #[Route('/', name: 'app_admin_crud_marque_index', methods: ['GET'])]
    public function index(MarqueRepository $marqueRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $marques = $marqueRepository->findAll();

        $pagination = $paginator->paginate(
            $marques,
            $request->query->getInt('page', 1),
            20
        );

        return $this->render('admin_crud_marque/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    #[Route('/new', name: 'app_admin_crud_marque_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $marque = new Marque();
        $form = $this->createForm(MarqueType::class, $marque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($marque);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_crud_marque_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_crud_marque/new.html.twig', [
            'marque' => $marque,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_crud_marque_show', methods: ['GET'])]
    public function show(Marque $marque): Response
    {
        return $this->render('admin_crud_marque/show.html.twig', [
            'marque' => $marque,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_crud_marque_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Marque $marque, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MarqueType::class, $marque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->flush();

            return $this->redirectToRoute('app_admin_crud_marque_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_crud_marque/edit.html.twig', [
            'marque' => $marque,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_crud_marque_delete', methods: ['POST'])]
    public function delete(Request $request, Marque $marque, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $marque->getId(), $request->request->get('_token'))) {
            $entityManager->remove($marque);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_crud_marque_index', [], Response::HTTP_SEE_OTHER);
    }
}
