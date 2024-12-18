<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\Mime\Email;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ResetPasswordRequestRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/crud/user')]
class AdminCrudUserController extends AbstractController
{
    #[Route('/', name: 'app_admin_crud_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $users = $userRepository->findAll();

        $pagination = $paginator->paginate(
            $users,
            $request->query->getInt('page', 1),
            20
        );

        return $this->render('admin_crud_user/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_crud_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('admin_crud_user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_crud_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, UserRepository $userRepository, MailerInterface $mailer, EntityManagerInterface $em): Response
    {
        $confirmedAvant = $user->isIsConfirmed();

        $monemail = new Email();
        $monemail->from('info@marconnet-robotique.com')
            ->to($user->getEmail())
            ->subject('Votre inscription chez Marconnet technologies™ confirmée !');
        $monemail->html("<p>Bonjour, votre compte chez Marconnet technologies™ a été validé par notre équipe !</p>");

        $form = $this->createForm(UserType::class, $user, ['is_admin' => true]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);

            $confirmedApres = $user->isIsConfirmed();

            if ($confirmedAvant == false && $confirmedApres == true) {
                $mailer->send($monemail);
            }


            return $this->redirectToRoute('app_admin_crud_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_crud_user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_crud_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, UserRepository $userRepository, ResetPasswordRequestRepository $resetPasswordRequestRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {

            $resetPasswordRequests = $resetPasswordRequestRepository->findBy(['user' => $user]);
            foreach ($resetPasswordRequests as $resetPasswordRequest) {
                $resetPasswordRequestRepository->remove($resetPasswordRequest, true);
            }
            $userRepository->remove($user, true);
        } else {
            $userRepository->NotRemove($user, true);
        }

        return $this->redirectToRoute('app_admin_crud_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
