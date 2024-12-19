<?php

namespace App\Service;

use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpKernel\KernelInterface;

class EmailService
{
    private $mailer;
    private $environment;

    public function __construct(MailerInterface $mailer, KernelInterface $kernel)
    {
        $this->mailer = $mailer;
        $this->environment = $kernel->getEnvironment();
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

        if ($this->environment !== 'prod') {
            // Logique pour les environnements autres que prod (par exemple, logs ou retour)
            error_log("Envoi d'email simulé (non envoyé en {$this->environment}). Sujet : $subject");
            return; // Ne pas envoyer l'email
        }

        $email = (new Email())
            ->from($from ?? 'info@marconnet-robotique.com') // Utiliser l'expéditeur par défaut si non fourni
            ->to($to)
            ->subject($subject)
            ->html($htmlContent);

        $this->mailer->send($email);
    }
}
