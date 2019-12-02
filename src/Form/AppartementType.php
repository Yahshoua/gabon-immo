<?php

namespace App\Form;

use App\Entity\Types;
use App\Entity\Appartement;
use App\Entity\Category;
use App\Entity\Photography;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
class AppartementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('photographies', CollectionType::class, [
            'entry_type'=> PhotographieType::class,
            'entry_options'=> [
                'label'=> false
            ],
            'by_reference'=> false,
            'allow_add'=> true,
            'allow_delete'=> true
        ])
            ->add('title', TextType::class, [
                'label'=> 'Titre de votre annonce',
                'attr'=> [
                    'placeholder'=> 'exemple: villa de luxe',
                    'class'=> 'input'
                ]
            ])
            ->add('quartier', TextType::class, [
                'label'=> 'Adresse',
                'attr'=> [
                    'placeholder'=> 'Adresse de votre bien',
                    'class'=> 'input'
                ]
            ])
            ->add('ville', TextType::class, [
                'attr'=> [
                    'placeholder'=> 'exemple: Libreville',
                    'class'=> 'input'
                ]
            ])
            ->add('annee', NumberType::class, [
                'label'=> 'Année de contruction (facultatif)',
                'attr'=> [
                    'placeholder'=> 'exemple: 2012',
                    'class'=> 'input',
                    'min'=> 1000
                ]
            ])
            ->add('douches', NumberType::class, [
                'label'=> 'Nombre de douche (facultatif)',
                'attr'=> [
                    'placeholder'=> 'exemple: 2',
                    'class'=> 'input',
                    'min'=> 0
                ]
            ])
            ->add('parking',  NumberType::class, [
                'label'=> 'Nombre de parking (facultaif)',
                'attr'=> [
                    'placeholder'=> 'exemple: 1',
                    'class'=> 'input',
                    'min'=> 0
                ]
            ])
            ->add('garage',NumberType::class, [
                'label'=> 'Nombre de garage (facultaif)',
                'attr'=> [
                    'placeholder'=> 'exemple: 1',
                    'class'=> 'input',
                    'min'=> 0
                ]
            ])
            ->add('surface',NumberType::class ,[
                'label'=> 'Espace en m2 (facultaif)',
                'attr'=> [
                    'placeholder'=> 'exemple: 300m2',
                    'class'=> 'input',
                    'min'=> 0
                ]
            ])
            ->add('chambres',NumberType::class ,[
                'label'=> 'Nombre de chambre (facultaif)',
                'attr'=> [
                    'placeholder'=> 'exemple: 1',
                    'class'=> 'input',
                    'min'=> 0
                ]
            ])
            ->add('etages',NumberType::class ,[
                'label'=> 'Nombre d\'etage (facultaif)',
                'attr'=> [
                    'placeholder'=> 'exemple: 1',
                    'class'=> 'input',
                    'min'=> 0
                ]
            ])
            ->add('piscines',NumberType::class , [
                'label'=> 'Nombre de piscine (facultaif)',
                'attr'=> [
                    'placeholder'=> 'exemple: 1',
                    'class'=> 'input',
                    'min'=> 0
                ]
            ])
            ->add('salons',NumberType::class , [
                'label'=> 'Nombre de salon (facultaif)',
                'attr'=> [
                    'placeholder'=> 'exemple: 1',
                    'class'=> 'input',
                    'min'=> 0
                ]
            ])
            ->add('balcons', NumberType::class ,[
                'label'=> 'Nombre de balcon (facultaif)',
                'attr'=> [
                    'placeholder'=> 'exemple: 1',
                    'class'=> 'input',
                    'min'=> 0
                ]
            ])
            ->add('cuisines',NumberType::class ,[
                'label'=> 'Nombre de cuisine (facultaif)',
                'attr'=> [
                    'placeholder'=> 'exemple: 1',
                    'class'=> 'input',
                    'min'=> 0
                ]
            ])
            ->add('Types', EntityType::class, [
                'label'=> 'Type de maison',
                'class'=> Types::class,
                'choice_label'=> 'types',
                'multiple'=> true,
                'attr'=> [
                    'placeholder'=> 'exemple: Duplex',
                    'class'=> 'input myType'
                ]
            ])
            ->add('Category', EntityType::class, [
                'label'=> 'Categorie de votre Maison',
                'class'=> Category::class,
                'choice_label'=> 'label',
                'attr'=> [
                    'class'=> 'input'
                ]
            ])
            ->add('tags', TextType::class, [
                'label'=> 'Specifications de votre bien (ajouter une specification en separant par une virgule)',
                'attr'=> [
                    'name'=> 'tags',
                    'id'=> 'appartement_tags'
                ]
            ])
            ->add('imageFile', FileType::class,[
                'label'=>false
            ]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Appartement::class,
        ]);
    }
}
