<?php

namespace App\Form;

use App\Entity\Post\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('q',TextType::class,[
                'label'=>false,
                'attr'=>[
                    'placeholder'=>'Rechercher'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'method'=>'GET',
            'data_class' => Post::class,
        ]);
    }
}
