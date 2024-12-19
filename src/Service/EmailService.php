<?php

namespace App\Service;

use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;

class EmailService
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Envoie un email.
     *
     * @param string $to          Destinataire
     * @param string $subject     Sujet de l'email
     * @param string $htmlContent Contenu HTML de l'email
     * @param string|null $from   Expéditeur (optionnel)
     * @return void
     */
    public function sendEmail(string $to, string $subject, string $htmlContent, ?string $from = null): void
    {
        $email = (new Email())
            ->from($from ?? 'info@marconnet-robotique.com') // Utiliser l'expéditeur par défaut si non fourni
            ->to($to)
            ->subject($subject)
            ->html($htmlContent);

        $this->mailer->send($email);
    }
}
