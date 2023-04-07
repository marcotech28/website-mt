<?php

namespace App\Controller;

use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MonCompteController extends AbstractController
{
    #[Route('/mon-compte', name: 'app_mon_compte')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {

        $user = $this->getUser();

        // dd($user);

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $em->flush();

            return $this->redirectToRoute('app_mon_compte');
        }

        $formView = $form->createView();

        return $this->render('mon_compte/index.html.twig', [
            'user' => $user,
            'formView' => $formView
        ]);
    }
}
