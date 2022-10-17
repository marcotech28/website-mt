<?php

namespace App\Controller;

use App\Form\DemonstrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DemonstrationController extends AbstractController
{
    #[Route('/demonstration', name: 'demonstration')]
    public function index(): Response
    {
        $form = $this->createForm(DemonstrationFormType::class);


        return $this->render('demonstration/demonstration.html.twig', [
            'formView' => $form->createView()
        ]);
    }
}
