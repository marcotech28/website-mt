<?php

namespace App\Controller;

use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MonCompteController extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    #[Route('/mon-compte', name: 'app_mon_compte')]
    public function index(Request $request, EntityManagerInterface $em): Response
    {

        $user = $this->getUser();

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $em->flush();

            return $this->redirectToRoute('app_mon_compte');
        }

        return $this->render('mon_compte/index.html.twig', [
            'user' => $user,
            'formView' => $form->createView()
        ]);
    }
}
