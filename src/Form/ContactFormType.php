<?php

namespace App\Form;

use Symfony\Component\Validator\Constraints as Assert;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Validator\Constraints\Length;

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
                    ]),
                    new Assert\Regex([
                        'pattern' => '/^[a-zA-Z\s]*$/',
                        'message' => 'Le nom ne peut contenir que des lettres',
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
                    ]),
                    new Assert\Regex([
                        'pattern' => '/^[a-zA-Z\s]*$/',
                        'message' => 'Le prénom ne peut contenir que des lettres',
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
                    ]),
                    new Assert\Regex([
                        'pattern' => '/^[0-9]*$/',
                        'message' => 'Le téléphone ne peut contenir que des chiffres',
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
                    ]),
                    new Assert\Regex([
                        'pattern' => '/^[a-zA-Z\s]*$/',
                        'message' => 'Le pays ne peut contenir que des lettres',
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
                    ]),
                ],
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
        //     ->add('objet', ChoiceType::class, [
        //         'attr' => [
        //             'class' => 'form-control form-select',
        //         ],
        //         'choices' => [
        //             'Demande de devis' => 'devis',
        //             'Demande de renseignement' => 'renseignement'
        //         ],
        //         'placeholder' => 'Objet',
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
