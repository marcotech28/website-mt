<?php

namespace App\Controller;

use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\DemonstrationRequestRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminDemonstrationController extends AbstractController
{
    #[Route('/admin/demonstration', name: 'app_admin_demonstration')]
    public function index(DemonstrationRequestRepository $demonstrationRequestRepository, PaginatorInterface $paginatorInterface, Request $request): Response
    {
        $demonstrationsRequests = $demonstrationRequestRepository->findBy([], ['createdAt' => 'DESC']);

        $pagination = $paginatorInterface->paginate(
            $demonstrationsRequests,
            $request->query->getInt('page', 1),
            20
        );

        return $this->render('admin_demonstration/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    #[Route('/admin/demonstration/show/{id}', name: 'app_admin_demonstration_show')]
    public function show(DemonstrationRequestRepository $demonstrationRequestRepository, int $id): Response
    {
        $demonstrationRequest = $demonstrationRequestRepository->find($id);

        if (!$demonstrationRequest) {
            throw $this->createNotFoundException('Demande de démonstration introuvable.');
        }

        return $this->render('admin_demonstration/show.html.twig', [
            'demonstrationRequest' => $demonstrationRequest,
        ]);
    }

    #[Route('/admin/demonstration/toggle/{id}', name: 'app_admin_demonstration_toggle')]
    public function toggleStatus(DemonstrationRequestRepository $demonstrationRequestRepository, int $id, EntityManagerInterface $em): Response 
    {
        $demonstrationRequest = $demonstrationRequestRepository->find($id);

        if (!$demonstrationRequest) {
            throw $this->createNotFoundException('Demande de démonstration introuvable.');
        }

        // Inversion du statut
        $demonstrationRequest->setEstTraitee(!$demonstrationRequest->isEstTraitee());

        $em->flush();

        // Redirection vers la liste
        return $this->redirectToRoute('app_admin_demonstration');
    }

    #[Route('/admin/demonstration/delete/{id}', name: 'app_admin_demonstration_delete', methods: ['POST'])]
    public function delete(DemonstrationRequestRepository $demonstrationRequestRepository, int $id, EntityManagerInterface $em): Response {
        $demonstrationRequest = $demonstrationRequestRepository->find($id);

        if (!$demonstrationRequest) {
            throw $this->createNotFoundException('Demande de démonstration introuvable.');
        }

        // Suppression de l'entité
        $em->remove($demonstrationRequest);
        $em->flush();

        // Redirection vers la liste
        return $this->redirectToRoute('app_admin_demonstration');
    }


}
