<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class DemonstrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('choixTypeUser', ChoiceType::class, [
                'label' => "Type d'utilisateur *",
                'choices' => [
                    'Un particulier' => true,
                    'Un professionnel de santé' => false
                ]
            ])
            ->add('societe', TextType::class, [
                'label' => 'Société'
            ])
            ->add('SIRET', TextType::class, [
                'label' => 'SIRET'
            ])
            ->add('nom', TextType::class, [
                'label' => 'Nom *'
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom *'
            ])
            ->add('Fonction', TextType::class, [
                'label' => 'Fonction dans la société *'
            ])
            ->add('email', EmailType::class, [
                'label' => 'Adresse mail *'
            ])
            ->add('telephone', TextType::class, [
                'label' => 'Téléphone *'
            ])
            ->add('adresse', TextType::class, [
                'label' => 'Adresse *'
            ])
            ->add('complementAdresse', TextType::class, [
                'label' => 'Complément d\'adresse'
            ])
            ->add('ville', TextType::class, [
                'label' => 'Ville *'
            ])
            ->add('codePostal', TextType::class, [
                'label' => 'Code Postal *'
            ])
            ->add('produitsInteresses', TextType::class, [
                'label' => 'Les produits que vous souhaitez essayer *'
            ])
            ->add('message', TextareaType::class, [
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
