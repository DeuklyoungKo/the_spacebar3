<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content')
//            ->add('publishedAt')
//            ->add('slug')
//            ->add('heartCount')
//            ->add('imageFilename')
//            ->add('createdAt')
//            ->add('updatedAt')
//            ->add('tags')
//            ->add('author')
        ;
    }
//
//    public function configureOptions(OptionsResolver $resolver)
//    {
//        $resolver->setDefaults([
//            'data_class' => Article::class,
//        ]);
//    }
}
