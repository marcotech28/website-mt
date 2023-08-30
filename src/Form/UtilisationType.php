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
            ->add('image', FileType::class, [
                'label' => 'Image',
                'required' => false, // pour autoriser l'envoi de formulaire sans la fiche descriptive
                'mapped' => false, // pour éviter que le champ ne soit mappé sur un attribut de l'entité
                'data_class' => null,
                'attr' => [
                    'data-filename' => $options['image_filename'] ?? null,
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
                    'rows' => '7',  // Définit le nombre de lignes visibles sans avoir à défiler
                    'class' => 'form-control'  // Classe Bootstrap pour styliser le textarea
                ],
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'rows' => '7',  // Définit le nombre de lignes visibles sans avoir à défiler
                    'class' => 'form-control'  // Classe Bootstrap pour styliser le textarea
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisation::class,
            'image_filename' => null,
        ]);
    }
}
