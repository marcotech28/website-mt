<?php

namespace App\Form;

use App\Entity\Categorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CategorieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle')
            ->add('slug')
            ->add('description', TextareaType::class, [
                'attr' => [
                    'rows' => '5',
                    'class' => 'tinymce'
                ],
            ])
            ->add('texteDeFin', TextareaType::class, [
                'attr' => [
                    'rows' => '5',
                    'class' => 'tinymce' 
                ],
            ])
            ->add('metaDesc')
            ->add('rang');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Categorie::class,
        ]);
    }
}
