<?php

namespace App\Form;

use App\Entity\Company;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('urlImage', TextareaType::class, [
                'label' => 'Lien de l\'image',
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ],
            ])
            ->add('libelle', TextType::class, [
                'label' => 'Nom de l\'entreprise',
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ],
            ])
            ->add('website', TextareaType::class, [
                'label' => 'Site internet de l\'entreprise',
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ],
            ])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Prestataire de santé' => 'Prestataire de santé',
                    'Établissement de santé' => 'Établissement de santé',
                ],
                'label' => 'Type d\'entreprise',
                'expanded' => false,
                'multiple' => false,
                'required' => true,
                'attr' => [
                    'class' => 'form-select',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Company::class,
        ]);
    }
}
