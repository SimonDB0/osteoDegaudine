<?php

namespace App\Form;

use App\Entity\Post\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class CommentType extends AbstractType
{

        public function buildForm(FormBuilderInterface $builder, array $options): void
        {
            $builder
                ->add('content', TextareaType::class, [
                    'label' => 'Commentaire',
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Veuillez saisir un commentaire'
                        ]),
                        new Length([
                            'min' => 3,
                            'minMessage' => 'Votre commentaire doit contenir au moins {{ limit }} caractères',
                            'max' => 1000,
                            'maxMessage' => 'Votre commentaire doit contenir au maximum {{ limit }} caractères'
                        ])
                    ],
                ]);

        }

        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => Comment::class
            ]);
        }
}
