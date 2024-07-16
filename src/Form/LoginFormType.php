<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class LoginFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class,  [
                'label' => 'Email',
                'attr' => [
                    'class' => 'w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500',
                    'placeholder' => 'Enter your email',
                ],
                'label_attr' => [
                    'class' => 'block text-gray-600', // Add your label class here
                ],
            ])

            ->add('password', PasswordType::class, [
                'label' => 'Password',
                'attr' => [
                    'class' => 'w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:border-blue-500',
                    'placeholder' => 'Enter your email',
                ],
                'label_attr' => [
                    'class' => 'block text-gray-600', // Add your label class here
                ],
            ])
            ->add('remember', CheckboxType::class, [
                'label' => 'Remember Me',
                'required' => false,
                'attr' => [
                    'class' => 'text-blue-500',
                ],
                'label_attr' => [
                    'class' => 'text-gray-600 ml-2',
                ],
            ]);
           
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'csrf_protection' => true,
            'csrf_field_name' => '_csrf_token',
            'csrf_token_id'   => 'authenticate',
        ]);
    }
}
