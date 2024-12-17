<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

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
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'required' => false
                ],
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
                    'class' => 'form-control'
                ]
            ]);

            // Champs spécifiques pour l'inscription
            if ($options['is_registration']) {
                $builder
                    ->add('password', PasswordType::class, [
                        'label' => 'Mot de passe',
                        'mapped' => true,
                        'attr' => ['autocomplete' => 'new-password', 'class' => 'form-control']
                    ])
                    ->add('agreeTerms', CheckboxType::class, [
                        'mapped' => false,
                        'constraints' => [
                            new IsTrue(['message' => 'Vous devez accepter les conditions.'])
                        ],
                        'label' => 'J\'accepte les conditions Marconnet technologies™',
                    ]);
            };

            // Champs spécifiques pour l'admin
            if ($options['is_admin']) {
                $builder
                    ->add('roles', ChoiceType::class, [
                        'choices' => [
                            'ROLE_USER' => 'ROLE_USER',
                            'ROLE_ADMIN' => 'ROLE_ADMIN',
                            'ROLE_SUPER_ADMIN' => 'ROLE_SUPER_ADMIN',
                        ],
                        'multiple' => true,
                        'expanded' => true,
                    ])
                    ->add('isConfirmed', CheckboxType::class, [
                        'label' => 'Utilisateur validé',
                        'required' => false,
                    ]);
            }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'is_admin' => false,
            'is_registration' => false,
        ]);
    }
}
