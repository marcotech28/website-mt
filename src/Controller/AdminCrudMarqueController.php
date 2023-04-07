<?php

namespace App\Controller;

use App\Entity\Marque;
use App\Form\MarqueType;
use App\Repository\MarqueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/admin/crud/marque')]
class AdminCrudMarqueController extends AbstractController
{
    #[Route('/', name: 'app_admin_crud_marque_index', methods: ['GET'])]
    public function index(MarqueRepository $marqueRepository): Response
    {
        return $this->render('admin_crud_marque/index.html.twig', [
            'marques' => $marqueRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_crud_marque_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $marque = new Marque();
        $form = $this->createForm(MarqueType::class, $marque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            self::handlePDFUpload($marque, $form, $entityManager);
            self::handleImageUpload($marque, $form, $entityManager);

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

            self::handlePDFUpload($marque, $form, $entityManager);
            self::handleImageUpload($marque, $form, $entityManager);


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



    // fonction upload PDF
    public function handlePDFUpload(Marque $marque, FormInterface $form, EntityManagerInterface $entityManager)
    {
        // récupération du fichier PDF
        $ficheDescriptiveFile = $form->get('catalogue')->getData();

        if ($ficheDescriptiveFile) {
            // récupération du nom d'origine du fichier
            $originalFilename = pathinfo($ficheDescriptiveFile->getClientOriginalName(), PATHINFO_FILENAME);


            try {
                // déplacement du fichier dans un dossier d'upload
                $ficheDescriptiveFile->move(
                    $this->getParameter('upload_directory'),
                    $originalFilename
                );
            } catch (FileException $e) {
                // erreur lors du déplacement du fichier
                // à gérer ici...
            }

            // mise à jour de la fiche descriptive du produit
            $marque->setCatalogue($originalFilename);
        }
    }


    public function handleImageUpload(Marque $marque, FormInterface $form, EntityManagerInterface $entityManager)
    {
        $logo = $form->get('logo')->getData();

        if ($logo) {
            // récupération du nom d'origine du fichier + son extension
            $originalLogo = pathinfo($logo->getClientOriginalName(), PATHINFO_BASENAME);

            // On met à jour l'emplacement de l'image dans l'entité Produit
            $marque->setLogo($originalLogo);
        }
    }
}
