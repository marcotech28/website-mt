<?php

namespace App\Form;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Email;



use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class DemonstrationFormType extends AbstractType
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
                'label' => false
            ])
            ->add('societe', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Société'
                ],
                'required' => false,
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'max' => 30,
                        'minMessage' => 'Le nom de la société doit contenir au moins {{ limit }} caractères',
                        'maxMessage' => 'Le nom de la société ne peut pas dépasser {{ limit }} caractères'
                    ])
                ]
            ])
            ->add('poste', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Votre poste'
                ],
                'required' => false,
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'max' => 30,
                        'minMessage' => 'Le poste doit contenir au moins {{ limit }} caractères',
                        'maxMessage' => 'Le poste ne peut pas dépasser {{ limit }} caractères'
                    ]),
                ]
            ])
            ->add('nom', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Nom *'
                ],
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'max' => 20,
                        'minMessage' => 'Le nom doit contenir au moins {{ limit }} caractères',
                        'maxMessage' => 'Le nom ne peut pas dépasser {{ limit }} caractères'
                    ]),
                ]
            ])
            ->add('prenom', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Prénom *'
                ],
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'max' => 20,
                        'minMessage' => 'Le prénom doit contenir au moins {{ limit }} caractères',
                        'maxMessage' => 'Le prénom ne peut pas dépasser {{ limit }} caractères'
                    ]),
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Adresse email *'
                ],
                'constraints' => [
                    new Length([
                        'min' => 3,
                        'max' => 40,
                        'minMessage' => 'L\'adresse email doit contenir au moins {{ limit }} caractères',
                        'maxMessage' => 'L\'adresse email ne peut pas dépasser {{ limit }} caractères'
                    ]),
                    new Email([
                        'message' => 'L\'adresse email n\'est pas valide'
                    ])
                ]
            ])
            ->add('telephone', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Téléphone *'
                ],
                'constraints' => [
                    new Length([
                        'min' => 5,
                        'max' => 20,
                        'minMessage' => 'Le numéro de téléphone doit contenir au moins {{ limit }} caractères',
                        'maxMessage' => 'Le numéro de téléphone ne peut pas dépasser {{ limit }} caractères'
                    ])
                ]
            ])
            ->add('adresse', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Adresse *'
                ],
                'constraints' => [
                    new Length([
                        'min' => 3,
                        'max' => 50,
                        'minMessage' => 'L\'adresse doit contenir au moins {{ limit }} caractères',
                        'maxMessage' => 'L\'adresse ne peut pas dépasser {{ limit }} caractères'
                    ])
                ]
            ])
            ->add('complementAdresse', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Complément d\'adresse'
                ],
                'required' => false,
                'constraints' => [
                    new Length([
                        'min' => 3,
                        'max' => 50,
                        'minMessage' => 'Le complément d\'adresse doit contenir au moins {{ limit }} caractères',
                        'maxMessage' => 'Le complément d\'adresse ne peut pas dépasser {{ limit }} caractères'
                    ])
                ]
            ])
            ->add('ville', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Ville *'
                ],
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'max' => 40,
                        'minMessage' => 'La ville doit contenir au moins {{ limit }} caractères',
                        'maxMessage' => 'La ville ne peut pas dépasser {{ limit }} caractères'
                    ]),
                ]
            ])
            ->add('codePostal', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Code postal *'
                ],
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'max' => 10,
                        'minMessage' => 'Le code postal doit contenir au moins {{ limit }} caractères',
                        'maxMessage' => 'Le code postal ne peut pas dépasser {{ limit }} caractères'
                    ])
                ]
            ])
            ->add('pays', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Pays *'
                ],
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'max' => 30,
                        'minMessage' => 'Le pays doit contenir au moins {{ limit }} caractères',
                        'maxMessage' => 'Le pays ne peut pas dépasser {{ limit }} caractères'
                    ]),
                ]
            ])
            ->add('produitsDemo', ChoiceType::class, [
                'choices'  => [
                    'Handbikes Stricker' => 'Handbikes Stricker',
                    'Tricycles VanRaam' => 'Tricycles VanRaam',
                    'Tricycles VanRaam' => 'Tricycles VanRaam',
                    'Scooters' => 'Scooters',
                    'Fauteil tout terrain' => 'Fauteil tout terrain',
                ],
                'expanded' => true,
                'multiple' => true,
                'label' => 'La gamme que vous voulez tester',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('lieuDemo', ChoiceType::class, [
                'attr' => [
                    'class' => 'form-control form-select',
                ],
                'choices' => [
                    'À votre domicile' => 'domicile',
                    'À notre showroom' => 'showroom'
                ],
                'placeholder' => 'Lieu de la démonstration',
                'label' => false
            ])
            ->add('message', TextareaType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre message...',
                    'class' => 'form-control',
                    'rows' => 4
                ],
                'constraints' => [
                    new Length([
                        'min' => 5,
                        'max' => 1000,
                        'minMessage' => 'Le message doit contenir au moins {{ limit }} caractères',
                        'maxMessage' => 'Le message ne peut pas dépasser {{ limit }} caractères'
                    ])
                ]
            ]);



        // $builder
        //     ->add('typeUser', ChoiceType::class, [
        //         'attr' => [
        //             'class' => 'form-control form-select',
        //         ],
        //         'choices' => [
        //             'Un particulier' => 'particulier',
        //             'Un professionnel de santé' => 'professionel'
        //         ],
        //         'placeholder' => 'Type d\'utilisateur',
        //         'label' => false
        //     ])
        //     ->add('societe', TextType::class, [
        //         'label' => false,
        //         'attr' => [
        //             'class' => 'form-control',
        //             'placeholder' => 'Société'
        //         ],
        //         'required' => false
        //     ])
        //     ->add('poste', TextType::class, [
        //         'label' => false,
        //         'attr' => [
        //             'class' => 'form-control',
        //             'placeholder' => 'Votre poste'
        //         ],
        //         'required' => false
        //     ])
        //     ->add('nom', TextType::class, [
        //         'label' => false,
        //         'attr' => [
        //             'class' => 'form-control',
        //             'placeholder' => 'Nom *'
        //         ]
        //     ])
        //     ->add('prenom', TextType::class, [
        //         'label' => false,
        //         'attr' => [
        //             'class' => 'form-control',
        //             'placeholder' => 'Prénom *'
        //         ]
        //     ])
        //     ->add('email', EmailType::class, [
        //         'label' => false,
        //         'attr' => [
        //             'class' => 'form-control',
        //             'placeholder' => 'Adresse email *'
        //         ]
        //     ])
        //     ->add('telephone', TextType::class, [
        //         'label' => false,
        //         'attr' => [
        //             'class' => 'form-control',
        //             'placeholder' => 'Téléphone *'
        //         ]
        //     ])
        //     ->add('adresse', TextType::class, [
        //         'label' => false,
        //         'attr' => [
        //             'class' => 'form-control',
        //             'placeholder' => 'Adresse *'
        //         ]
        //     ])
        //     ->add('complementAdresse', TextType::class, [
        //         'label' => false,
        //         'attr' => [
        //             'class' => 'form-control',
        //             'placeholder' => 'Complément d\'adresse'
        //         ],
        //         'required' => false
        //     ])
        //     ->add('ville', TextType::class, [
        //         'label' => false,
        //         'attr' => [
        //             'class' => 'form-control',
        //             'placeholder' => 'Ville *'
        //         ]
        //     ])
        //     ->add('codePostal', TextType::class, [
        //         'label' => false,
        //         'attr' => [
        //             'class' => 'form-control',
        //             'placeholder' => 'Code postal *'
        //         ]
        //     ])
        //     ->add('pays', TextType::class, [
        //         'label' => false,
        //         'attr' => [
        //             'class' => 'form-control',
        //             'placeholder' => 'Pays *'
        //         ]
        //     ])
        //     ->add('produitsDemo', ChoiceType::class, [
        //         'choices'  => [
        //             'Produit 1' => 'prod1',
        //             'Produit 2' => 'prod2',
        //             'Produit 3' => 'prod3',
        //             'Produit 4' => 'prod4',
        //             'Produit 5' => 'prod5',
        //         ],
        //         'expanded' => true,
        //         'multiple' => true,
        //         'label' => 'Les produits que vous voulez tester',
        //         'attr' => [
        //             'class' => 'form-control',
        //         ],
        //     ])
        //     ->add('lieuDemo', ChoiceType::class, [
        //         'attr' => [
        //             'class' => 'form-control form-select',
        //         ],
        //         'choices' => [
        //             'À votre domicile' => 'domicile',
        //             'À notre showroom' => 'showroom'
        //         ],
        //         'placeholder' => 'Lieu de la démonstration',
        //         'label' => false
        //     ])
        //     ->add('message', TextareaType::class, [
        //         'label' => false,
        //         'attr' => [
        //             'placeholder' => 'Votre message...',
        //             'class' => 'form-control',
        //             'rows' => 4
        //         ]
        //     ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
