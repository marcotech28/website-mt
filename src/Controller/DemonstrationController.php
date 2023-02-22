<?php

namespace App\Controller;

use Symfony\Component\Mime\Email;
use App\Form\DemonstrationFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DemonstrationController extends AbstractController
{
    #[Route('/demonstration', name: 'demonstration')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(DemonstrationFormType::class);

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
            $produitsDemo = $data['produitsDemo'];
            $lieuDemo = $data['lieuDemo'];
            $message = $data['message'];


            $monemail = new Email();
            $monemail->from($email)
                ->to('antonin@marconnet-robotique.com')
                ->subject('Demande de démonstration');
            $a = "
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
                    <p><strong>Produits souhaités démo:</strong></p>
                    <ul>
            ";

            $b = "";
            foreach ($produitsDemo as $produit) {
                $b = $b . "<li>" . $produit . "</li>";
            }

            $c = "</ul>
            <p><strong>Lieu démo:</strong> {$lieuDemo}</p>
            <p><strong>Message:</strong> {$message}</p>";

            $monemail->html($a . $b . $c);


            $mailer->send($monemail);
        }




        return $this->render('demonstration/demonstration.html.twig', [
            'formView' => $form->createView()
        ]);
    }
}
