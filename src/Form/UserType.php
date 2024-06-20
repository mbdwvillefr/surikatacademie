<?php
// UserType 是一个表单类型类，用于定义用户实体User的表单结构和验证规则。
// 通过定义UserType，您可以在创建、编辑用户时使用它来渲染表单、验证用户输入，并将数据绑定到用户实体上。

namespace App\Form;

use App\Entity\User;
use App\Entity\UserCategory; // 确保正确引入 UserCategory 实体
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                  'label' => 'Name',
                  'constraints' => [
                    new NotBlank(), //NotBlank确保字段不为空，
                    new Length(['min' => 2, 'max' => 255]),
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'constraints' => [
                    new NotBlank(),
                    new Length(['max' => 255]),
                ],
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Password',
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 6]),
                ],
            ])
            ->add('category', EntityType::class, [
                'class' => UserCategory::class,
                'choice_label' => 'name',
                'label' => 'Category',
                'placeholder' => 'Select Category',
                'required' => true,
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Submit',
                'attr' => ['class' => 'btn btn-primary'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
