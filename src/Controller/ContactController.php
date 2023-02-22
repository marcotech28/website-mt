<?php

namespace App\Controller;

use App\Form\ContactFormType;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
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
                ->to('antonin@marconnet-robotique.com')
                ->subject($objet)
                ->text($message)
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
            ");

            $mailer->send($monemail);


            // dd($data);
        }

        return $this->render(
            'contact/contact.html.twig',
            [
                'formView' => $form->createView()
            ]
        );
    }
}
