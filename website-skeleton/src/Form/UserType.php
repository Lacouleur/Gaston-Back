<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username')
            ->add('email')
            ->add('password')
            ->add('addressLabel')
            ->add('lat')
            ->add('lng')
            ->add('firstname')
            ->add('lastname')
            ->add('description')
            ->add('picture')
            ->add('phoneNumber')
            ->add('organisation')
            ->add('status')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('roles')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
