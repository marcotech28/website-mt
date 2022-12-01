<?php

namespace App\Controller;

use App\Entity\Avantage;
use App\Form\Avantage1Type;
use App\Repository\AvantageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/crud/avantage')]
class AdminCrudAvantageController extends AbstractController
{
    #[Route('/', name: 'app_admin_crud_avantage_index', methods: ['GET'])]
    public function index(AvantageRepository $avantageRepository): Response
    {
        return $this->render('admin_crud_avantage/index.html.twig', [
            'avantages' => $avantageRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_crud_avantage_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $avantage = new Avantage();
        $form = $this->createForm(Avantage1Type::class, $avantage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($avantage);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_crud_avantage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_crud_avantage/new.html.twig', [
            'avantage' => $avantage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_crud_avantage_show', methods: ['GET'])]
    public function show(Avantage $avantage): Response
    {
        return $this->render('admin_crud_avantage/show.html.twig', [
            'avantage' => $avantage,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_crud_avantage_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Avantage $avantage, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Avantage1Type::class, $avantage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_crud_avantage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_crud_avantage/edit.html.twig', [
            'avantage' => $avantage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_crud_avantage_delete', methods: ['POST'])]
    public function delete(Request $request, Avantage $avantage, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $avantage->getId(), $request->request->get('_token'))) {
            $entityManager->remove($avantage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_crud_avantage_index', [], Response::HTTP_SEE_OTHER);
    }
}
