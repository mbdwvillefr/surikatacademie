<?php

namespace App\Controller;

use App\Entity\Company;// 引入 Company 实体类
use App\Form\CompanyType; // 引入 CompanyType 表单类型类
use Doctrine\ORM\EntityManagerInterface;// 引入 Doctrine 的 EntityManager 接口
use Symfony\Component\HttpFoundation\Request; // 引入 Symfony 的 Request 类
use Symfony\Component\HttpFoundation\Response; // 引入 Symfony 的 Response 类
use Symfony\Component\Routing\Annotation\Route; // 引入 Symfony 的 Route 注解
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; // 引入 Symfony 的抽象控制器类

class CompanyController extends AbstractController // 继承 Symfony 的抽象控制器类
{
    private EntityManagerInterface $entityManager; // 定义私有属性 EntityManagerInterface，用于操作实体

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/company', name: 'company_index', methods: ['GET'])]
    public function index(): Response
    {
         // 通过 EntityManager 获取所有的 Company 实体
        $companies = $this->entityManager->getRepository(Company::class)->findAll();

        // 渲染并返回包含公司列表的 Twig 模板
        return $this->render('company/index.html.twig', [
            'companies' => $companies,
        ]);
    }

    #[Route('/company/new', name: 'company_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $company = new Company();// 创建一个新的 Company 实体对象
        $form = $this->createForm(CompanyType::class, $company);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($company);
            $this->entityManager->flush();

            return $this->redirectToRoute('company_index');
        }

        return $this->render('company/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/company/{id}', name: 'company_show', methods: ['GET'])]
    public function show(Company $company): Response
    {
        return $this->render('company/show.html.twig', [
            'company' => $company,
        ]);
    }

    #[Route('/company/{id}/edit', name: 'company_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Company $company): Response
    {
        $form = $this->createForm(CompanyType::class, $company);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute('company_index');
        }

        return $this->render('company/edit.html.twig', [
            'company' => $company,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/company/{id}', name: 'company_delete', methods: ['POST'])]
    public function delete(Request $request, Company $company): Response
    {
        if ($this->isCsrfTokenValid('delete' . $company->getId(), $request->request->get('_token'))) {
            $this->entityManager->remove($company);
            $this->entityManager->flush();
        }

        return $this->redirectToRoute('company_index');
    }
}
