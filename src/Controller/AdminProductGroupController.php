<?php

namespace App\Controller;

use App\Entity\ProductGroup;
use App\Form\ProductGroupType;
use App\Repository\ProductGroupRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminProductGroupController extends AbstractController
{
    #[Route('/admin/product-group', name: 'app_admin_product_group')]
    public function index(ProductGroupRepository $productGroupRepository): Response
    {
        $productGroups = $productGroupRepository->findAll();

        return $this->render('admin_productGroup/index.html.twig', [
            'productGroups' => $productGroups
        ]);
    }

    #[Route('/admin/product-group/new', name: 'app_admin_product_group_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $productGroup = new ProductGroup();
        $form = $this->createForm(ProductGroupType::class, $productGroup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($productGroup);
            $entityManager->flush();

            $this->addFlash('success', 'Le groupe de produits a été créé avec succès.');

            return $this->redirectToRoute('app_admin_product_group');
        }

        return $this->render('admin_productGroup/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/admin/product-group/edit/{id}', name: 'app_admin_product_group_edit')]
    public function edit(
        int $id,
        ProductGroupRepository $productGroupRepository,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        $productGroup = $productGroupRepository->find($id);

        if (!$productGroup) {
            throw $this->createNotFoundException('Le groupe de produits demandé n\'existe pas.');
        }

        $form = $this->createForm(ProductGroupType::class, $productGroup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Le groupe de produits a été mis à jour avec succès.');

            return $this->redirectToRoute('app_admin_product_group');
        }

        return $this->render('admin_productGroup/edit.html.twig', [
            'form' => $form->createView(),
            'productGroup' => $productGroup,
        ]);
    }

}
