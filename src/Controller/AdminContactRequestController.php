<?php

namespace App\Controller;

use App\Repository\ContactRequestRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminContactRequestController extends AbstractController
{
    #[Route('/admin/contact-request', name: 'app_admin_contact-request')]
    public function index(ContactRequestRepository $contactRequestRepository, PaginatorInterface $paginatorInterface, Request $request): Response
    {
        $contactRequests = $contactRequestRepository->findBy([], ['createdAt' => 'DESC']);

        $pagination = $paginatorInterface->paginate(
            $contactRequests,
            $request->query->getInt('page', 1),
            20
        );

        return $this->render('admin_contact-request/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    #[Route('/admin/contact-request/show/{id}', name: 'app_admin_contact-request_show')]
    public function show(ContactRequestRepository $contactRequestRepository, int $id): Response
    {
        $contactRequest = $contactRequestRepository->find($id);

        if (!$contactRequest) {
            throw $this->createNotFoundException('Demande de contact introuvable.');
        }

        return $this->render('admin_contact-request/show.html.twig', [
            'contactRequest' => $contactRequest,
        ]);
    }

    #[Route('/admin/contact-request/toggle/{id}', name: 'app_admin_contact-request_toggle')]
    public function toggleStatus(ContactRequestRepository $contactRequestRepository, int $id, EntityManagerInterface $em): Response 
    {
        $contactRequest = $contactRequestRepository->find($id);

        if (!$contactRequest) {
            throw $this->createNotFoundException('Demande de démonstration introuvable.');
        }

        // Inversion du statut
        $contactRequest->setEstTraitee(!$contactRequest->isEstTraitee());

        $em->flush();

        // Redirection vers la liste
        return $this->redirectToRoute('app_admin_contact-request');
    }

    #[Route('/admin/contact-request/delete/{id}', name: 'app_admin_contact-request_delete', methods: ['POST'])]
    public function delete(ContactRequestRepository $contactRequestRepository, int $id, EntityManagerInterface $em): Response {
        $contactRequest = $contactRequestRepository->find($id);

        if (!$contactRequest) {
            throw $this->createNotFoundException('Demande de contact introuvable.');
        }

        // Suppression de l'entité
        $em->remove($contactRequest);
        $em->flush();

        // Redirection vers la liste
        return $this->redirectToRoute('app_admin_contact-request');
    }


}
