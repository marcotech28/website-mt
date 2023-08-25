<?php

namespace App\Security;

use App\Entity\User;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserValidationChecker implements UserCheckerInterface
{
    public function checkPreAuth(UserInterface $user): void
    {
        if (!$user instanceof User) {
            return;
        }

        // Vérifiez si l'utilisateur a été validé
        if (!$user->isIsConfirmed()) {
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
