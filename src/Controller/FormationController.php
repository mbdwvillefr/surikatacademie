<?php

namespace App\Controller;

use App\Entity\Formation;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//引入 Doctrine\ORM\EntityManagerInterface类，
//该接口提供了操作实体管理器（EntityManager）的方法。
use Doctrine\ORM\EntityManagerInterface;

#[Route('/formation')]
class FormationController extends AbstractController
{
    private EntityManagerInterface $entityManager; //声明EntityManagerInterface属性

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager; //通过构造函数注入EntityManager
    }

    #[Route('/', name: 'app_formation_index', methods: ['GET'])]
    public function index(): Response
    { 
        $formations = $this->entityManager->getRepository(Formation::class)->findAll();

        return $this->render('formation/index.html.twig', [
            'formations' => $formations,
        ]);
    }

    #[Route('/{id}', name: 'app_formation_show', methods: ['GET'])]
    public function show(int $id): Response
    {
        $formation = $this->entityManager->getRepository(Formation::class)->find($id);

        if (!$formation) {
            throw $this->createNotFoundException('Formation not found');
        }

        return $this->render('formation/show.html.twig', [
            'formation' => $formation,
        ]);
    }
}
