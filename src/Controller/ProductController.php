<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'product_product')]
    public function index(): Response
    {
        return $this->render('product/show.html.twig');
    }

    #[Route('/products', name: 'product_product')]
    public function listeProduits(): Response
    {
        return $this->render('product/liste.html.twig');
    }
}
