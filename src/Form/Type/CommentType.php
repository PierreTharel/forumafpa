<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CommentType 
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content', TextareaType::class, [
                'label' => 'Votre message'
            ])
            ->add('article', HiddenType::class)
            ->add('send', SubmitType::class, [
                'label' => 'Envoyer'
            ]);

        $builder->get('article')
            ->addModelTransformer(new CallbackTransformer(
                fn (Article $article) => $article->getId(),
                fn (Article $article) => $article->getTitle()));
    }
}