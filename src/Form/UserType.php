<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            // ->add('roles')
            // ->add('password')
            ->add('prenom')
            ->add('nom')
            ->add('telephone')
            ->add('pays')
            ->add('adresse')
            ->add('complementAdresse')
            ->add('region')
            ->add('ville')
            ->add('codePostal')
            ->add('newsletter')
            ->add('nomSociete')
            ->add('siret')
            ->add('civilite');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
