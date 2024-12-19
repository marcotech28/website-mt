<?php

namespace App\Controller;

use App\Form\ContactFormType;
use App\Service\EmailService;
use App\Entity\ContactRequest;
use Symfony\Component\Mime\Email;
use App\Service\RecaptchaValidator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function index(Request $request, RecaptchaValidator $recaptchaValidator, EntityManagerInterface $em, EmailService $emailService): Response
    {
        $form = $this->createForm(ContactFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $recaptchaResponse = $request->request->get('g-recaptcha-response');

            if (!$recaptchaResponse) {
                $this->addFlash('error', 'Le reCAPTCHA est requis.');
                return $this->redirectToRoute('contact');
            }

            if (!$recaptchaValidator->validate($recaptchaResponse)) {
                $this->addFlash('error', 'Le reCAPTCHA n\'a pas été validé.');
                return $this->redirectToRoute('contact');
            }

            $data = $form->getData();

            // Création et remplissage de l'entité Contact
            $contactRequest = new ContactRequest();
            $contactRequest
                ->setTypeUser($data['typeUser'])
                ->setSociete($data['societe'])
                ->setPoste($data['poste'])
                ->setNom($data['nom'])
                ->setPrenom($data['prenom'])
                ->setEmail($data['email'])
                ->setTelephone($data['telephone'])
                ->setAdresse($data['adresse'])
                ->setComplementAdresse($data['complementAdresse'])
                ->setVille($data['ville'])
                ->setCodePostal($data['codePostal'])
                ->setPays($data['pays'])
                ->setObjet($data['objet'])
                ->setMessage($data['message'])
                ->setCreatedAt(new \DateTime());

            // Sauvegarde de l'entité en base de données
            $em->persist($contactRequest);
            $em->flush();

            $htmlContent = "
                <p><strong>Type d'utilisateur:</strong> {$contactRequest->getTypeUser()}</p>
                <p><strong>Nom:</strong> {$contactRequest->getNom()}</p>
                <p><strong>Prénom:</strong> {$contactRequest->getPrenom()}</p>
                <p><strong>Email:</strong> {$contactRequest->getEmail()}</p>
                <p><strong>Société:</strong> {$contactRequest->getSociete()}</p>
                <p><strong>Poste:</strong> {$contactRequest->getPoste()}</p>
                <p><strong>Téléphone:</strong> {$contactRequest->getTelephone()}</p>
                <p><strong>Adresse:</strong> {$contactRequest->getAdresse()}</p>
                <p><strong>Complément d'adresse:</strong> {$contactRequest->getComplementAdresse()}</p>
                <p><strong>Ville:</strong> {$contactRequest->getVille()}</p>
                <p><strong>Code postal:</strong> {$contactRequest->getCodePostal()}</p>
                <p><strong>Pays:</strong> {$contactRequest->getPays()}</p>
                <p><strong>Message:</strong> {$contactRequest->getMessage()}</p>
            ";
            
            // Envoi de l'email
            $emailService->sendEmail(
                'info@marconnet-robotique.com', // Destinataire
                $contactRequest->getObjet(),    // Sujet
                $htmlContent                    // Contenu HTML
            );
    

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
