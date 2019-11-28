<?php

namespace App\Form;

use App\Entity\Commentaires;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class FormCommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'attr'=> [
                    'placeholder'=> 'Votre Nom',
                    'class'=> 'input'
                ]
            ])
            ->add('prenom', TextType::class, [
                'attr'=> [
                    'placeholder'=> 'Votre prenom',
                    'class'=> 'input'
                ]
            ])
            ->add('email', EmailType::class, [
                'attr'=> [
                    'placeholder'=> 'Votre Message',
                    'class'=> 'input'
                ]
            ])
            ->add('textes', TextareaType::class, [
                'label'=> 'Votre message',
                'attr'=> [
                    'placeholder'=> 'Votre Message',
                    'class'=>'textarea'
                ]
            ])
            ->add('titre', TextType::class, [
                'label'=> 'Titre de votre message',
                'attr'=> [
                    'placeholder'=> 'Titre de votre Message',
                    'class'=> 'input'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commentaires::class,
            'csrf_protection' => false
        ]);
    }
}
