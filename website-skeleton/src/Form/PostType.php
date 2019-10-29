<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('picture')
            ->add('addressLabel')
            ->add('lat')
            ->add('lng')
            ->add('nbLikes')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('user')
            ->add('postStatus')
            ->add('visibility')
            ->add('wearCondition')
            ->add('category')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
