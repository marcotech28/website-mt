<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Utilisation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class UtilisationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle')
            ->add('metaDesc')
            ->add('image', TextareaType::class, [
                'label' => 'Image',
                'required' => false, // pour autoriser l'envoi de formulaire sans la fiche descriptive
                'attr' => [
                    'class' => 'form-control'
                ],
            ])
            ->add('slug')
            ->add('categorie', EntityType::class, [
                'label' => 'Categorie',
                'placeholder' => '-- Choisir une catégorie --',
                'class' => Categorie::class,
                'choice_label' => function (Categorie $categorie) {
                    return $categorie->getLibelle();
                }
            ])
            ->add('texteDeFin', TextareaType::class, [
                'attr' => [
                    'rows' => '7', 
                    'class' => 'tinymce'
                ],
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'rows' => '7', 
                    'class' => 'tinymce'
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisation::class,
        ]);
    }
}
