<?php

namespace App\Form;

use App\Entity\Marque;
use App\Entity\Produit;
use App\Entity\Categorie;
use App\Entity\Utilisation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            // ->add('nom', TextareaType::class, [
            //     'label' => 'Nom',
            //     'required' => false,
            //     'attr' => [
            //         'class' => 'form-control'
            //     ],
            // ])
            ->add('prix')
            ->add('description', TextareaType::class, [
                'attr' => [
                    'rows' => '10',  // Définit le nombre de lignes visibles sans avoir à défiler
                    'class' => 'form-control'  // Classe Bootstrap pour styliser le textarea
                ],
            ])
            ->add('shortDescription')
            ->add('metaDesc')
            ->add('motsCles')
            ->add('avantages')
            ->add('video1')
            ->add('video2')
            ->add('ficheDescriptive', TextareaType::class, [
                'label' => 'Fiche descriptive',
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ],
            ])
            ->add('caracteristiques')
            ->add('slug')
            ->add('categorie', EntityType::class, [
                'label' => 'Categorie',
                'placeholder' => '-- Choisir une catégorie --',
                'class' => Categorie::class,
                'choice_label' => function (Categorie $categorie) {
                    return $categorie->getLibelle();
                }
            ])
            ->add('utilisation', EntityType::class, [
                'required' => false,
                'label' => 'Utilisation',
                'placeholder' => '-- Choisir un type d\'utilisation --',
                'class' => Utilisation::class,
                'choice_label' => function (Utilisation $utilisation) {
                    return $utilisation->getLibelle();
                }
            ])
            ->add('marque', EntityType::class, [
                'label' => 'Marque',
                'placeholder' => '-- Choisir une marque --',
                'class' => Marque::class,
                'choice_label' => function (Marque $marque) {
                    return $marque->getLibelle();
                }
            ])
            ->add('image1', TextareaType::class, [
                'label' => 'Image 1',
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ],
            ])
            ->add('image2', TextareaType::class, [
                'label' => 'Image 2',
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ],
            ])
            ->add('image3', TextareaType::class, [
                'label' => 'Image 3',
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ],
            ])
            ->add('image4', TextareaType::class, [
                'label' => 'Image 4',
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ],
            ])
            ->add('image5', TextareaType::class, [
                'label' => 'Image 5',
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ],
            ])

            ->add('produitsSimilaires', EntityType::class, [
                'class' => Produit::class,
                'choice_label' => 'nom',
                'multiple' => true,
                'expanded' => false, //on met ça à true pour avoir une liste à puce
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
