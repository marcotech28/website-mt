<?php

namespace App\Controller;

use App\Form\ContactFormType;
use Symfony\Component\Mime\Email;
use App\Service\RecaptchaValidator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function index(Request $request, MailerInterface $mailer, RecaptchaValidator $recaptchaValidator): Response
    {
        $form = $this->createForm(ContactFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $recaptchaResponse = $request->request->get('g-recaptcha-response');
            if (!$recaptchaValidator->validate($recaptchaResponse)) {
                $this->addFlash('error', 'Le reCAPTCHA n\'a pas été validé.');
                return $this->redirectToRoute('contact');
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
            $objet = $data['objet'];
            $message = $data['message'];

            $monemail = new Email();
            $monemail->from($email)
                ->to('info@marconnet-technologies.com')
                ->subject($objet)
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
                    <p><strong>Message:</strong> {$message}</p>
            ");

            $mailer->send($monemail);

            $this->addFlash('success', "Votre demande de contact a bien été prise en compte. Nous l'étudierons et nous reviendrons vers vous très prochainement.");
            return $this->redirectToRoute('homepage');
        }

        return $this->render('contact/contact.html.twig', [
                'formView' => $form->createView(),
                'google_recaptcha_site_key' => $_ENV['GOOGLE_RECAPTCHA_SITE_KEY']
            ]
        );
    }
}
