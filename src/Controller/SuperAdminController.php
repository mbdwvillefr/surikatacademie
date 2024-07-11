<?php

// src/Controller/SuperAdminController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/superadmin', name: 'superadmin')]
class SuperAdminController extends AbstractController
{
    #[Route('/users', name: 'users_index')]
    public function index(UserRepository $userRepo): Response
    {
        // 确保只有超级管理员可以访问此页面
        $this->denyAccessUnlessGranted('ROLE_SUPER_ADMIN');

        return $this->render('superadmin/users/index.html.twig', [
            'users' => $userRepo->findAll(),
        ]);
    }

    #[Route('/users/{id}/promote', name: 'users_promote')]
    public function promote(int $id, UserRepository $userRepo, EntityManagerInterface $entityManager): Response
    {
        // 确保只有超级管理员可以访问此页面
        $this->denyAccessUnlessGranted('ROLE_SUPER_ADMIN');

        $user = $userRepo->find($id);
        if ($user) {
            $user->addRole('ROLE_ADMIN');
            $entityManager->flush();

            $this->addFlash('success', 'User promoted to admin.');
        } else {
            $this->addFlash('error', 'User not found.');
        }

        return $this->redirectToRoute('superadmin_users_index');
    }

    // 其他管理用户的方法...
}
