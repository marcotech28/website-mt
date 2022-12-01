<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => "Email"
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Merci d\'accepter nos conditions d\'utilisations',
                    ]),
                ],
                'label' => "J'accepte les conditions Marconnet technologies™"
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'label' => "Mot de passe",
                'mapped' => false,
                'attr' => [
                    'autocomplete' => 'new-password'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez choisir un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit contenir au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add(
                'civilite',
                ChoiceType::class,
                [
                    'choices' => [
                        'Un homme' => true,
                        'Une femme' => false
                    ],
                    'label' => 'Je suis '
                ]
            )
            ->add('nom', TextType::class, [
                'label' => "Nom"
            ])
            ->add('prenom', TextType::class, [
                'label' => "Prénom"
            ])
            ->add('telephone', TextType::class, [
                'label' => "Téléphone"
            ])
            ->add('nomSociete', TextType::class, [
                'label' => "Société"
            ])
            ->add('siret', TextType::class, [
                'label' => "Numéro de SIRET"
            ])
            ->add('pays', TextType::class, [
                'label' => "Pays"
            ])
            ->add('adresse', TextType::class, [
                'label' => "Adresse",
            ])
            ->add('complementAdresse', TextType::class, [
                'label' => "Complément d'adresse"
            ])
            ->add('region', TextType::class, [
                'label' => "Région"
            ])
            ->add('ville', TextType::class, [
                'label' => "Ville"
            ])
            ->add('codePostal', TextType::class, [
                'label' => "Code postal"
            ])
            ->add('newsletter', CheckboxType::class, [
                'label' => 'Je m\'abonne à la newsletter',
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
