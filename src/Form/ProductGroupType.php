<?php

namespace App\Form;

use App\Entity\Produit;
use App\Entity\ProductGroup;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ProductGroupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle', TextType::class, [
                'label' => 'Nom du groupe',
                'required' => true,
            ])
            ->add('produits', EntityType::class, [
                'class' => Produit::class,
                'choice_label' => 'nom', // Affiche le nom des produits dans la liste
                'multiple' => true,      // Permet de sélectionner plusieurs produits
                'expanded' => true,      // Affiche des cases à cocher
                'label' => 'Produits à inclure dans le groupe',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProductGroup::class,
        ]);
    }
}
