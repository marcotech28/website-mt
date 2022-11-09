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
                'attr' => ['placeholder' => 'Votre email'],
                'label' => false
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
                'label' => false,
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password', 'placeholder' => 'Votre mot de passe'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
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
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre nom'
                ],
            ])
            ->add('prenom', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre prenom'
                ],
            ])
            ->add('telephone', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre téléphone'
                ],
            ])
            ->add('nomSociete', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Nom du revendeur médical'
                ],
            ])
            ->add('siret', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Numéro de SIRET'
                ],
            ])
            ->add('pays', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre pays'
                ],
            ])
            ->add('adresse', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre adresse'
                ],
            ])
            ->add('complementAdresse', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Complément d\'adresse'
                ],
            ])
            ->add('region', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre région'
                ],
            ])
            ->add('ville', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre ville'
                ],
            ])
            ->add('codePostal', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre code postal'
                ],
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
