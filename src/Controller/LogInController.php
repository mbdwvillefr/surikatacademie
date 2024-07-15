<?php

namespace App\Controller;

use App\Form\LoginFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LogInController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function login(Request $request,AuthenticationUtils $authenticationUtils): Response
    {
        // 如果用户已登录，重定向到主页
        if ($this->getUser()) {
            return $this->redirectToRoute('home');
        }
        // 获取登录错误信息（如果有）
        $error = $authenticationUtils->getLastAuthenticationError();
        // 获取最后输入的用户名
        $lastUsername = $authenticationUtils->getLastUsername();

        // 创建登录表单
        $form = $this->createForm(LoginFormType::class, [
            'username' => $lastUsername,
        ]);

        return $this->render('log_in/login.html.twig', [
            'form' => $form->createView(),
            'error' => $error,
        ]);    }

    #[Route('/logout', name: 'logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}


