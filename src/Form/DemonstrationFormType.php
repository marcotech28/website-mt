<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class DemonstrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('choixTypeUser', ChoiceType::class, [
                'choices' => [
                    'Un particulier' => true,
                    'Un professionnel de santé' => false
                ]
            ])
            ->add('nom', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre nom'
                ]
            ])
            ->add('prenom', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre prénom'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre email'
                ]
            ])
            ->add('societe', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre société'
                ]
            ])
            ->add('codePostal', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre code postal'
                ]
            ])
            ->add('ville', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre ville'
                ]
            ])
            ->add('adresse', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre adresse'
                ]
            ])
            ->add('complementAdresse', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre Complément d\'adresse'
                ]
            ])
            ->add('telephone', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre numéro de téléphone'
                ]
            ])
            ->add('produitsInteresses', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Veuillez indiquer les produits que vous souhaitez essayer'
                ]
            ])
            ->add('message', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre message...'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
