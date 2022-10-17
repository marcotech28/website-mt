<?php

namespace App\Controller;

use App\Form\ContactFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function index(): Response
    {
        $form = $this->createForm(ContactFormType::class);

        return $this->render(
            'contact/contact.html.twig',
            [
                'formView' => $form->createView()
            ]
        );
    }
}
