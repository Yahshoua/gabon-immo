<?php

namespace App\Form;

use App\Entity\Utilisateurs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label'=> 'Email',
                'attr'=> [
                    'placeholder'=> "Entrez l\'email",
                    'class'=> 'input'
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type'=> passwordType::class,
                'invalid_message'=> 'le mot de passe ne correspond pas',
                'options'=> [
                    'attr'=> [
                        'class'=>'input'
                    ]
                    ],
                    'required'=> true,
                    'first_options'=> ['label'=> 'Mot de passe'],
                    'second_options'=> ['label'=> 'confirmer mot de passe']
            ])
            ->add('tags', CollectionType::class, [
                'entry_type' => TagType::class,
                'entry_options' => ['label' => false],
            ]);
            // ->add('password', PasswordType::class, [
            //     'label'=> 'Mot de passe',
            //     'attr'=> [
            //         'placeholder'=> "Entrez le mot de passe",
            //         'class'=> 'input'
            //     ]
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Utilisateurs::class,
            'error_mapping' => [
                '.' => 'email',
            ],
        ]);
    }
}
