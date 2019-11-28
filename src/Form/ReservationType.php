<?php

namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fullname', TextType::class, [
                'label'=> false,
                'attr'=> [
                    'placeholder'=> 'Nom complet',
                    'class'=> 'input'
                ]
            ])
            ->add('email', EmailType::class, [
                'label'=> false,
                'attr'=> [
                    'placeholder'=> 'Adresse mail',
                    'class'=> 'input'
                ]
            ] )
            ->add('numero', NumberType::class, [
                'label'=> false,
                'attr'=> [
                   'placeholder'=> 'Numero de Tel',
                    'class'=> 'input' 
                ]
            ])
            ->add('dates', TextType::class, [
                'label'=> false,
                'attr'=> [
                    'placeholder'=> 'Date de reservation',
                    'class'=> 'input picked'
                ]
            ])
            ->add('dates2', TextType::class, [
                'label'=> false,
                'attr'=> [
                    'placeholder'=> 'Date de sortie',
                    'class'=> 'input picked'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
