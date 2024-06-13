<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserCategory;
use App\Repository\UserRepository;
use App\Repository\UserCategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    //在这个控制器中，我们定义了一个路由 /user/create，当访问这个路由时，会创建一个新的用户分类和用户，并将用户分配到该分类中。
    #[Route('/user/create', name: 'user_create')]
    public function createUser(Request $request, EntityManagerInterface $entityManager): Response
    {
        // 创建一个新的用户分类
        $category = new UserCategory();
        $category->setName('Administrator');
        
        // 创建一个新的用户，并将其分配给上述分类
        $user = new User($category);
        $user->setName('Loki B');
        $user->setEmail('loki.b@example.com');
        $user->setPassword('123456');

        // 将用户添加到分类
        $category->addUser($user);

        // 将实体持久化到数据库中
        $entityManager->persist($category);
        $entityManager->persist($user);
        $entityManager->flush();

        return new Response('User and category created successfully.');
    }
}

