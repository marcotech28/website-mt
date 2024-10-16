<?php

namespace App\Form;

use App\Entity\News;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use App\Form\DataTransformer\StringToFileTransformer;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class NewsType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('sousTitre')
            ->add('titreSlug')
            ->add('contenu', TextareaType::class, [
                'attr' => [
                    'rows' => '7',  // Définit le nombre de lignes visibles sans avoir à défiler
                    'class' => 'tinymce'  // Classe Bootstrap pour styliser le textarea
                ],
                'required' => false
            ])
            ->add('image', TextareaType::class, [
                'label' => 'Image',
                'required' => false, // pour autoriser l'envoi de formulaire sans la fiche descriptive
                'attr' => [
                    'class' => ''
                ],
            ])
            ->add('metaDesc')
            ->add('date')
            ->add('auteur');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => News::class,
        ]);
    }
}
