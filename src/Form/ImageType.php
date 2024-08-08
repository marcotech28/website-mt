<?php

namespace App\Form;

use App\Entity\Image;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('url', TextType::class, [
                'label' => 'URL de l\'image',
                'attr' => [
                    'placeholder' => 'Entrez l\'URL de l\'image'
                ]
            ])
            ->add('alt', TextType::class, [
                'label' => 'Texte alt',
                'attr' => [
                    'placeholder' => 'Entrez le texte alt pour l\'image'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Image::class,
        ]);
    }
}
