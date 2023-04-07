<?php

namespace App\Form;

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
                'required' => false
            ])
            ->add('poste', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Votre poste'
                ],
                'required' => false
            ])
            ->add('nom', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Nom *'
                ]
            ])
            ->add('prenom', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Prénom *'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Adresse email *'
                ]
            ])
            ->add('telephone', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Téléphone *'
                ]
            ])
            ->add('adresse', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Adresse *'
                ]
            ])
            ->add('complementAdresse', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Complément d\'adresse'
                ],
                'required' => false
            ])
            ->add('ville', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Ville *'
                ]
            ])
            ->add('codePostal', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Code postal *'
                ]
            ])
            ->add('pays', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Pays *'
                ]
            ])
            ->add('produitsDemo', ChoiceType::class, [
                'choices'  => [
                    'Produit 1' => 'prod1',
                    'Produit 2' => 'prod2',
                    'Produit 3' => 'prod3',
                    'Produit 4' => 'prod4',
                    'Produit 5' => 'prod5',
                ],
                'expanded' => true,
                'multiple' => true,
                'label' => 'Les produits que vous voulez tester',
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
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
