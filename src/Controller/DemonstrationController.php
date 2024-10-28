<?php

namespace App\Controller;

use Symfony\Component\Mime\Email;
use App\Form\DemonstrationFormType;
use App\Service\RecaptchaValidator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DemonstrationController extends AbstractController
{
    #[Route('/demonstration', name: 'demonstration')]
    public function index(Request $request, MailerInterface $mailer, RecaptchaValidator $recaptchaValidator): Response
    {
        $form = $this->createForm(DemonstrationFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $recaptchaResponse = $request->request->get('g-recaptcha-response');
            
            if (!$recaptchaResponse) {
                $this->addFlash('error', 'Le reCAPTCHA est requis.');
                return $this->redirectToRoute('demonstration');
            }

            if (!$recaptchaValidator->validate($recaptchaResponse)) {
                $this->addFlash('error', 'Le reCAPTCHA n\'a pas été validé.');
                return $this->redirectToRoute('demonstration');
            }

            $data = $form->getData();

            $typeUser = $data['typeUser'];
            $societe = $data['societe'];
            $poste = $data['poste'];
            $nom = $data['nom'];
            $prenom = $data['prenom'];
            $email = $data['email'];
            $telephone = $data['telephone'];
            $adresse = $data['adresse'];
            $complementAdresse = $data['complementAdresse'];
            $ville = $data['ville'];
            $codePostal = $data['codePostal'];
            $pays = $data['pays'];
            $lieuDemo = $data['lieuDemo'];
            $message = $data['message'];

            $monemail = (new Email())
                ->from($email)
                ->to('antonin.cavanne@outlook.fr')
                ->subject('Demande de démonstration')
                ->html("
                    <p><strong>Type d'utilisateur:</strong> {$typeUser}</p>
                    <p><strong>Nom:</strong> {$nom}</p>
                    <p><strong>Prénom:</strong> {$prenom}</p>
                    <p><strong>Email:</strong> {$email}</p>
                    <p><strong>Société:</strong> {$societe}</p>
                    <p><strong>Poste:</strong> {$poste}</p>
                    <p><strong>Téléphone:</strong> {$telephone}</p>
                    <p><strong>Adresse:</strong> {$adresse}</p>
                    <p><strong>Complément d'adresse:</strong> {$complementAdresse}</p>
                    <p><strong>Ville:</strong> {$ville}</p>
                    <p><strong>Code postal:</strong> {$codePostal}</p>
                    <p><strong>Pays:</strong> {$pays}</p>
                    <p><strong>Lieu démo:</strong> {$lieuDemo}</p>
                    <p><strong>Message:</strong> {$message}</p>
                ");

            $mailer->send($monemail);

            $this->addFlash('success', "Votre demande de démonstration a bien été prise en compte. Notre équipe l'étudiera dans les plus brefs délais. Nous vous répondrons très prochainement par mail.");
            return $this->redirectToRoute('homepage');
        }

        return $this->render('demonstration/demonstration.html.twig', [
            'formView' => $form->createView(),
            'google_recaptcha_site_key' => $_ENV['GOOGLE_RECAPTCHA_SITE_KEY']
        ]);
    }
}
