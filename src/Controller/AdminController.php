<?php

// src/Controller/AdminController.php
namespace App\Controller;

use Doctrine\Persistence\ObjectRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin', name: 'admin')]
class AdminController extends AbstractController
{
    #[Route('/objects', name: 'objets_index')]
    public function index(ObjectRepository $objectRepo): Response
    {
        // 确保只有管理员可以访问此页面
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('admin/objects/index.html.twig', [
            'objects' => $objectRepo->findAll(),
        ]);
    }

    // 其他管理对象的方法...
}

