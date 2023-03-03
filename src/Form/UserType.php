<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prenom', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('nom', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            // ->add('roles')
            ->add('password', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('telephone', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('pays', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('adresse', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('complementAdresse', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('ville', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('codePostal', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('fonction', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('newsletter', CheckboxType::class, [
                'label_attr' => ['style' => 'display:inline-block; padding-right: 10px;'],
                'required' => false,
            ])
            ->add('nomSociete', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            // ->add('isConfirmed')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
