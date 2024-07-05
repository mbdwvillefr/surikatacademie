<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LogInController extends AbstractController
{
    #[Route('/login', name:'login')]
    public function login(AuthenticationUtils $authenticationUtils)
    {
        // 如果用户已登录，重定向到仪表板或其他页面
        if ($this->isGranted('ROLE_USER')) {
            return $this->redirectToRoute('dashboard');
        }
        /// 获取登录错误（如果有）
        $error = $authenticationUtils->getLastAuthenticationError();

        // 获取最后输入的用户名
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('log_in/index.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }
}


