<?php

namespace App\Form;

use App\Entity\GetTouche;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class GetTouchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nom',TextType::class, [
                'label'=> 'Nom',
                'attr'=> [
                    'class'=> 'input inputwrapper'
                ]
            ])
            ->add('Sujet',TextType::class, [
                'label'=> "Sujet",
                'attr'=> [
                    'class'=> 'input inputwrapper'
                ]
            ])
            ->add('Email',TextType::class, [
                'label'=> 'votre email',
                'attr'=> [
                    'class'=> 'input inputwrapper'
                ]
            ])
            ->add('Prenom',TextType::class, [
                'label'=> 'Prenom',
                'attr'=> [
                    'class'=> 'input inputwrapper'
                ]
            ])
            ->add('Message',TextareaType::class, [
                'label'=> 'message',
                'attr'=> [
                    'class'=> 'textarea textareawrapper'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => GetTouche::class
        ]);
    }
}
