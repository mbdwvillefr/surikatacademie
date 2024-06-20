<?php
namespace App\Controller;

use App\Entity\InfoUser;
use App\Form\InfoUserType;
use Doctrine\ORM\EntityManagerInterface; // 导入实体管理器接口
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InfoUserController extends AbstractController
{
    #[Route('/info_user/new', name: 'info_user_new', methods: ['GET', 'POST'])]//这个路由可以处理这两种类型的请求。
    //EntityManagerInterface：这个接口表示了实体管理器，
    //它是与数据库交互的主要接口。EntityManager负责对实体进行持久化操作，如保存、更新和删除。
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $infoUser = new InfoUser();
        $form = $this->createForm(InfoUserType::class, $infoUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           /* $entityManager = $this->getDoctrine()->getManager();
           因为有了EntityManager，所以不需要这个了*/
            $entityManager->persist($infoUser);
            $entityManager->flush();

            return $this->redirectToRoute('info_user_show', ['id' => $infoUser->getId()]);
        }

        return $this->render('info_user/new.html.twig', [
            'infoUser' => $infoUser,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/info_user/{id}', name: 'info_user_show', methods: ['GET'])]
    public function show(InfoUser $infoUser): Response
    {
        return $this->render('info_user/show.html.twig', [
            'infoUser' => $infoUser,
        ]);
    }
}
