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

        $produit = $options['data'];

        $builder
            ->add('nom')
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
                'label' => 'Fiche Descriptive (PDF file)',
                'required' => false, // pour autoriser l'envoi de formulaire sans la fiche descriptive
                'class' => 'form-control'  // Classe Bootstrap pour styliser le textarea
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
            ->add('image1', TextareaType::class, [])
            ->add('image2', FileType::class, [
                'label' => 'Image 2',
                'required' => false, // pour autoriser l'envoi de formulaire sans la fiche descriptive
                'data_class' => null,
                'attr' => [
                    'data-filename' => $options['image2_filename'] ?? null,
                ],

            ])
            ->add('image3', FileType::class, [
                'label' => 'Image 3',
                'required' => false, // pour autoriser l'envoi de formulaire sans la fiche descriptive
                'mapped' => false, // pour éviter que le champ ne soit mappé sur un attribut de l'entité
                'data_class' => null,
                'attr' => [
                    'data-filename' => $options['image3_filename'] ?? null,
                ],

            ])
            ->add('image4', FileType::class, [
                'label' => 'Image 4',
                'required' => false, // pour autoriser l'envoi de formulaire sans la fiche descriptive
                'mapped' => false, // pour éviter que le champ ne soit mappé sur un attribut de l'entité
                'data_class' => null,
                'attr' => [
                    'data-filename' => $options['image4_filename'] ?? null,
                ],

            ])
            ->add('image5', FileType::class, [
                'label' => 'Image 5',
                'required' => false, // pour autoriser l'envoi de formulaire sans la fiche descriptive
                'mapped' => false, // pour éviter que le champ ne soit mappé sur un attribut de l'entité
                'data_class' => null,
                'attr' => [
                    'data-filename' => $options['image5_filename'] ?? null,
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
            'image1_filename' => null,
            'image2_filename' => null,
            'image3_filename' => null,
            'image4_filename' => null,
            'image5_filename' => null,
            'ficheDescriptive_filename' => null,
        ]);
    }
}
