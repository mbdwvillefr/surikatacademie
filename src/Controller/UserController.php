<?php
// UserController将处理用户的创建、查看、编辑和删除等操作。
//用户可以是学生、讲师、管理员或超级管理员，每个角色具有不同的权限和功能。
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

use App\Entity\User;
use App\Form\UserType;


class UserController extends AbstractController
{
    private $entityManager; // 实体管理器

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/users', name: 'user_list', methods: ['GET'])]
    public function listUsers(): Response
    {
        $users = $this->entityManager->getRepository(User::class)->findAll();

        return $this->render('user/index.html.twig', [
            'users' => $users,
        ]);
    }

    //在这个控制器中，我们定义了一个路由 /user/create，当访问这个路由时，会创建一个新的用户分类和用户，并将用户分配到该分类中。
    #[Route('/user/new', name: 'user_create',methods: ['GET', 'POST'])]
    public function createUser(Request $request): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($user);
            $this->entityManager->flush();

      //Flash 消息: 在重定向后显示成功或错误消息，帮助用户理解操作的结果。
            $this->addFlash('success', 'User created successfully.');
            return $this->redirectToRoute('user_list');
        }

        return $this->render('user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
}

    #[Route('/user/{id}', name: 'user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/user/{id}/edit', name: 'user_edit', methods: ['GET','POST'])]
    public function edit(User $user, Request $request): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            $this->addFlash('success', 'User updated successfully.');
            return $this->redirectToRoute('user_list');
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/user/{id}', name: 'user_delete', methods: ['DELETE'])]
    public function deleteUser(User $user): Response
    {
        $this->entityManager->remove($user);
        $this->entityManager->flush();

        $this->addFlash('success', 'User deleted successfully.');
        return $this->redirectToRoute('user_list');
    }
}

