<?php
//当用户需要注册新账户时，可以使用一个专门的 RegistrationController来处理注册过程。
//包括用户注册表单的展示、处理和验证。
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
    private $entityManager;
    private $passwordHasher;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher)
    {
        $this->entityManager = $entityManager;//用于管理实体
        $this->passwordHasher = $passwordHasher;//用于加密用户密码
    }

    #[Route('/register', name: 'user_register', methods: ['GET', 'POST'])]
    public function register(Request $request): Response
    {
        $user = new User();
//使用createForm创建注册表单，表单类型为RegistrationFormType，关联到User实体。
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

//处理表单提交并验证数据的有效性        
        if ($form->isSubmitted() && $form->isValid()) {
            // Encode the plain password 对普通密码进行编码
            $user->setPassword(
                $this->passwordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            // Persist the user entity 持久化用户实体
            //如果表单提交且有效，首先对用户的密码进行加密处理，然后将用户实体持久化到数据库中。
            $this->entityManager->persist($user);
            $this->entityManager->flush();

            // TODO: Handle successful registration (e.g., send confirmation email) 注册成功后，可以在此处添加发送确认邮件等操作

            // Redirect to a success page or login page
            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
