<?php

namespace App\Form;

use App\Entity\Marque;
use App\Entity\Produit;
use App\Form\ImageType;
use App\Entity\Categorie;
use App\Entity\Utilisation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextareaType::class, [
                'label' => 'Nom',
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ],
            ])
            ->add('prix')
            ->add('description', TextareaType::class, [
                'attr' => [
                    'rows' => '10',
                    'class' => 'tinymce'
                ],
            ])
            ->add('shortDescription', TextareaType::class, [
                'attr' => [
                    'rows' => '3',
                    'class' => 'tinymce'
                ],
            ])
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
            ->add('images', CollectionType::class, [
                'entry_type' => ImageType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'prototype' => true,
                'prototype_name' => '__name__',
            ])
            ->add('produitsSimilaires', EntityType::class, [
                'class' => Produit::class,
                'choice_label' => 'nom',  // Propriété affichée comme label
                'multiple' => true,       // Permet plusieurs choix
                'expanded' => true,       // Affiche les options comme des cases à cocher
                'required' => false       // Rendre le champ facultatif
            ])
            ->add('isDraft', CheckboxType::class, [
                'label' => 'Est-ce un brouillon ? Cocher si oui',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
