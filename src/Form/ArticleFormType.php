<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
class ArticleFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label'=> 'Titre',
                'attr'=> [
                    'placeholder'=> 'Entrer le titre',
                    'class'=> 'input'
                ]
            ])
            ->add('author', TextType::class, [
                'label'=> 'auteur',
                'attr'=> [
                    'placeholder'=> 'Entrer l\'auteur',
                    'class'=> 'input'
                ]
            ])
            ->add('content', TextareaType::class, [
                'label'=> 'Description',
                'attr'=> [
                    'placeholder'=> 'Entrer la description',
                    'class'=> 'input'
                ]
            ])
            ->add('imageFile', FileType::class, [
                'label'=> 'Ajouter une image',
                'attr'=> [
                    'name'=> 'image'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
