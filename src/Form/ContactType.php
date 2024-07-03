<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            ->add('name', TextType::class, [
                'label' => 'Your Name',
                'required' => true,
                'attr' => [
                    'class' => 'block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm shadow-blue-500 ring-1 ring-inset ring-blue-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-400 sm:text-sm sm:leading-6',
                    'placeholder' => 'Your name',
                ],
                'label_attr' => [
                    'class' => 'block text-sm font-semibold leading-6 text-black', // Add your label class here
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'required' => true,
                'attr' => [
                    'autocomplete' => 'email',
                    'class' => 'block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset shadow-blue-500 ring-blue-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-400 sm:text-sm sm:leading-6',
                    'placeholder' => 'Your email address',
                ],
                'label_attr' => [
                    'class' => 'block text-sm font-semibold leading-6 text-red-600', // Add your label class here
                ],
            ])
            ->add('subject', TextType::class, [
                'label' => 'Subject',
                'required' => true,
                'attr' => [
                    'autocomplete' => 'email',
                    'class' => 'block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset shadow-blue-500 ring-blue-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-400 sm:text-sm sm:leading-6',
                    'placeholder' => 'Enter a subject',
                ],
                'label_attr' => [
                    'class' => 'block text-sm font-semibold leading-6 text-green-600', // Add your label class here
                ],
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Message',
                'required' => true,
                'attr' => [
                    'rows' => 5,
                    'class' => 'block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6',
                    'placeholder' => 'Enter your comment or query...',
                ],
                'label_attr' => [
                    'class' => 'block text-sm font-semibold leading-6 text-green-600', // Add your label class here
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class, // 设置表单的数据类
        ]);
    }
}
