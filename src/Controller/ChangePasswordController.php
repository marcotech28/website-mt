<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Mime\Email;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;


class ChangePasswordController extends AbstractController
{
    #[Route('/change-password', name: 'app_change_password')]
    public function changePassword(Request $request, MailerInterface $mailer, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        if (!$user instanceof PasswordAuthenticatedUserInterface) {
            throw new \LogicException('The user is not authenticated.');
        }

        $form = $this->createFormBuilder()
            ->add('oldPassword', PasswordType::class, [
                'label' => 'Mot de passe actuel',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('newPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passe doivent être identiques.',
                'required' => true,
                'first_options'  => ['label' => 'Nouveau mot de passe', 'attr' => [
                    'class' => 'form-control',
                ]],
                'second_options' => ['label' => 'Confirmation du nouveau mot de passe', 'attr' => [
                    'class' => 'form-control',
                ]],

            ])
            ->add('save', SubmitType::class, ['label' => 'Je change mon mot de passe', 'attr' => [
                'class' => 'btn btn-primary btnSavePswd',

            ]])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            if (!$passwordHasher->isPasswordValid($user, $data['oldPassword'])) {
                throw new BadCredentialsException('The old password is invalid.');
            }

            $hashedPassword = $passwordHasher->hashPassword($user, $data['newPassword']);
            $user->setPassword($hashedPassword);
            $entityManager->flush();

            $this->addFlash('success', 'Votre mot de passe a bien été changé.');

            $monemail = new Email();
            $monemail->from('info@marconnet-robotique.com')
                ->to($user->getEmail())
                ->subject('Changement de mot de passe');
            $monemail->html("<p>Bonjour, votre mot de passe sur Marconnet technologies™ a bien été changé.</p>");

            $mailer->send($monemail);

            return $this->redirectToRoute('homepage');
        }

        return $this->render('change_password/index.html.twig', [
            'formView' => $form->createView(),
        ]);
    }
}
