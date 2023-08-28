<?php

namespace App\Security;

use App\Entity\User;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;

class UserValidationChecker implements UserCheckerInterface
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function checkPreAuth(UserInterface $user): void
    {
        if (!$user instanceof User) {
            return;
        }

        // Vérifiez si l'utilisateur a été validé
        if (!$user->isIsConfirmed()) {

            // dd("ssddef");

            $this->session->getFlashBag()->add(
                'warning',
                'Votre e-mail n\'a toujours pas été validé par notre équipe, veuillez patienter ou veuillez nous contacter.'
            );

            throw new CustomUserMessageAuthenticationException(
                'Votre compte n\'a pas encore été validé par l\'administrateur.'
            );
        }
    }

    public function checkPostAuth(UserInterface $user): void
    {
        // Ici, vous pouvez ajouter des vérifications après l'authentification si nécessaire
    }
}
