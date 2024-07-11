<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'register')]
    //处理密码的哈希化应在表单处理过程中完成：在提交注册表单时，应该在控制器中使用密码哈希器 (UserPasswordHasherInterface) 来对 plainPassword 进行哈希处理，并将哈希后的值设置到 User 实体类的 password 属性中。
    public function register(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // 在控制器中直接从表单字段获取其数据, not from the User entity
            $plainPassword = $form->get('plainPassword')->getData();

            // Hash the password and set it on the User entity
            $user->setPassword(
                $passwordHasher->hashPassword(
                    $user,
                    $plainPassword
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();

            // Do anything else you need here, like send an email

            //set a "flash" success message for the user
            $this->addFlash('success', 'Successfully registered!');

            return $this->redirectToRoute('login');
        }

        return $this->render('registration/index.html.twig', [
            'form' => $form->createView(),// 这里使用 'form' 作为变量名
        ]);
    }
}
