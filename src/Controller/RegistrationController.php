<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;

use Symfony\Component\Mime\Email;
use App\Security\LoginFormAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/sinscrire', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, LoginFormAuthenticator $authenticator, EntityManagerInterface $entityManager,  MailerInterface $mailer): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user, ['is_registration' => true]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setCreatedAt(new \DateTimeImmutable());

            // Définir la date de consentement si agreeTerms est coché
            if ($form->get('agreeTerms')->getData()) {
                $user->setConsentAt(new \DateTimeImmutable());
            }

            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('password')->getData()
                )
            );

            $user->setIsConfirmed(false);

            $monemail = new Email();
            $monemail->from('info@marconnet-robotique.com')
                ->to('info@marconnet-robotique.com')
                ->subject('Demande d\'inscription sur le site Marconnet technologies™ !');
            $monemail->html("<p>Une nouvelle personne souhaite s'inscrire sur le site Internet. <p>");
            $mailer->send($monemail);

            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', "Votre demande de création de compte a bien été prise en compte. Notre équipe l'étudiera dans les plus briefs délais. Un email vous sera envoyé lors de la validation de votre compte.");
            return $this->redirectToRoute('homepage');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
