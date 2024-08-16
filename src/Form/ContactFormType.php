<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Symfony\Component\Form\Extension\Core\Type\HiddenType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('typeUser', ChoiceType::class, [
                'attr' => [
                    'class' => 'form-control form-select',
                ],
                'choices' => [
                    'Un particulier' => 'particulier',
                    'Un professionnel de santé' => 'professionel'
                ],
                'placeholder' => 'Type d\'utilisateur',
            ])
            ->add('societe', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Société'
                ],
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'min' => 2,
                        'max' => 30,
                        'minMessage' => 'La société doit comporter au moins {{ limit }} caractères.',
                        'maxMessage' => 'La société ne peut pas dépasser {{ limit }} caractères.',
                    ]),
                ],
            ])
            ->add('poste', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Votre poste'
                ],
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'min' => 2,
                        'max' => 20,
                        'minMessage' => 'Le poste doit comporter au moins {{ limit }} caractères.',
                        'maxMessage' => 'Le poste ne peut pas dépasser {{ limit }} caractères.',
                    ]),
                ],
            ])
            ->add('nom', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Nom *'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length([
                        'min' => 2,
                        'max' => 20,
                        'minMessage' => 'Le nom doit comporter au moins {{ limit }} caractères.',
                        'maxMessage' => 'Le nom ne peut pas dépasser {{ limit }} caractères.',
                    ]),
                ],
            ])
            ->add('prenom', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Prénom *'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length([
                        'min' => 2,
                        'max' => 20,
                        'minMessage' => 'Le prénom doit comporter au moins {{ limit }} caractères.',
                        'maxMessage' => 'Le prénom ne peut pas dépasser {{ limit }} caractères.',
                    ]),
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Adresse email *'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length([
                        'min' => 5,
                        'max' => 50,
                        'minMessage' => 'L\'email doit comporter au moins {{ limit }} caractères.',
                        'maxMessage' => 'L\'email ne peut pas dépasser {{ limit }} caractères.',
                    ]),
                    new Assert\Email(),
                ],
            ])
            ->add('telephone', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Téléphone *'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length([
                        'min' => 5,
                        'max' => 15,
                        'minMessage' => 'Le téléphone doit comporter au moins {{ limit }} caractères.',
                        'maxMessage' => 'Le téléphone ne peut pas dépasser {{ limit }} caractères.',
                    ]),
                ],
            ])
            ->add('adresse', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Adresse *'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length([
                        'min' => 3,
                        'max' => 30,
                        'minMessage' => 'L\'adresse doit comporter au moins {{ limit }} caractères.',
                        'maxMessage' => 'L\'adresse ne peut pas dépasser {{ limit }} caractères.',
                    ]),
                ],
            ])
            ->add('complementAdresse', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Complément d\'adresse'
                ],
                'required' => false,
                'constraints' => [
                    new Assert\Length([
                        'min' => 5,
                        'max' => 30,
                        'minMessage' => 'Le complément d\'adresse doit comporter au moins {{ limit }} caractères.',
                        'maxMessage' => 'Le complément d\'adresse ne peut pas dépasser {{ limit }} caractères.',
                    ]),
                ],
            ])
            ->add('ville', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Ville *'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length([
                        'min' => 3,
                        'max' => 40,
                        'minMessage' => 'La ville doit comporter au moins {{ limit }} caractères.',
                        'maxMessage' => 'La ville ne peut pas dépasser {{ limit }} caractères.',
                    ]),
                ],
            ])
            ->add('codePostal', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Code postal *'
                ],
                'constraints' => [
                    new Assert\Length([
                        'max' => 10,
                    ]),
                ],
            ])
            ->add('pays', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Pays *'
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length([
                        'min' => 3,
                        'max' => 30,
                        'minMessage' => 'Le pays doit comporter au moins {{ limit }} caractères.',
                        'maxMessage' => 'Le pays ne peut pas dépasser {{ limit }} caractères.',
                    ]),
                ],
            ])
            ->add('objet', ChoiceType::class, [
                'attr' => [
                    'class' => 'form-control form-select',
                ],
                'choices' => [
                    'Demande de devis' => 'devis',
                    'Demande de renseignements' => 'renseignement'
                ],
                'placeholder' => 'Objet',
            ])
            ->add('message', TextareaType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre message...',
                    'class' => 'form-control',
                    'rows' => 4
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length([
                        'min' => 5,
                        'minMessage' => 'Le message doit comporter au moins {{ limit }} caractères.',
                    ]),
                ],
            ])
            ->add('recaptcha', HiddenType::class, [
                'mapped' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
