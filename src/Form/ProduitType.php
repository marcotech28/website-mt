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

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $produit = $options['data'];

        $builder
            ->add('nom')
            ->add('prix')
            ->add('description')
            ->add('shortDescription')
            ->add('metaDesc')
            ->add('motsCles')
            ->add('avantages')
            ->add('video1')
            ->add('video2')
            ->add('ficheDescriptive', FileType::class, [
                'label' => 'Fiche Descriptive (PDF file)',
                'required' => false, // pour autoriser l'envoi de formulaire sans la fiche descriptive
                'mapped' => false // pour éviter que le champ ne soit mappé sur un attribut de l'entité
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
            ->add('image1', FileType::class, [
                'label' => 'Image 1',
                'required' => false, // pour autoriser l'envoi de formulaire sans la fiche descriptive
                'mapped' => false, // pour éviter que le champ ne soit mappé sur un attribut de l'entité
            ])
            ->add('image2', FileType::class, [
                'label' => 'Image 2',
                'required' => false, // pour autoriser l'envoi de formulaire sans la fiche descriptive
                'mapped' => false // pour éviter que le champ ne soit mappé sur un attribut de l'entité
            ])
            ->add('image3', FileType::class, [
                'label' => 'Image 3',
                'required' => false, // pour autoriser l'envoi de formulaire sans la fiche descriptive
                'mapped' => false // pour éviter que le champ ne soit mappé sur un attribut de l'entité
            ])
            ->add('image4', FileType::class, [
                'label' => 'Image 4',
                'required' => false, // pour autoriser l'envoi de formulaire sans la fiche descriptive
                'mapped' => false // pour éviter que le champ ne soit mappé sur un attribut de l'entité
            ])
            ->add('image5', FileType::class, [
                'label' => 'Image 5',
                'required' => false, // pour autoriser l'envoi de formulaire sans la fiche descriptive
                'mapped' => false // pour éviter que le champ ne soit mappé sur un attribut de l'entité
            ])
            ->add('produitsSimilaires', EntityType::class, [
                'class' => Produit::class,
                'choice_label' => 'nom',
                'multiple' => true,
                'expanded' => false, //on met ça à true pour avoir une liste à puce
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
