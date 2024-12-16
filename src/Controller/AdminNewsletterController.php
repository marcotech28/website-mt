<?php

namespace App\Controller;

use App\Repository\NewsletterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminNewsletterController extends AbstractController
{
    #[Route('/admin/newsletter', name: 'app_admin_newsletter')]
    public function index(NewsletterRepository $newsletterRepository, PaginatorInterface $paginatorInterface, Request $request): Response
    {
        $newsletters = $newsletterRepository->findBy([], ['createdAt' => 'DESC']);

        $pagination = $paginatorInterface->paginate(
            $newsletters,
            $request->query->getInt('page', 1),
            20
        );

        return $this->render('admin_newsletter/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    #[Route('/admin/newsletter/delete/{id}', name: 'app_admin_newsletter_delete', methods: ['POST'])]
    public function delete(NewsletterRepository $newsletterRepository, int $id, EntityManagerInterface $em): Response {
        $newsletter = $newsletterRepository->find($id);

        if (!$newsletter) {
            throw $this->createNotFoundException('Newsletter introuvable.');
        }

        // Suppression de l'entité
        $em->remove($newsletter);
        $em->flush();

        // Redirection vers la liste
        return $this->redirectToRoute('app_admin_newsletter');
    }
}
