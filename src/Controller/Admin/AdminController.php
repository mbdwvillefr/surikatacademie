<?php
//管理员工管理用户和角色
namespace App\Controller\Admin;

use App\Entity\StudentPlan;
use App\Form\StudentPlanType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Annotation\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/admin')]
// #[IsGranted("ROLE_ADMIN")]//使用 [IsGranted("ROLE_ADMIN")] 注解来确保只有具有 ROLE_ADMIN 角色的用户可以访问整个控制器。
class AdminController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    #[Route('/', name: 'admin_dashboard')]
    public function index(): Response
    {
      // Your logic to manage academy info, courses, students, and plans

        $academyInfo = []; // Fetch academy info from database or service

        // De gérer les différents cours et informations les concernant.
        $courses = []; // Fetch courses info from database or service

        // Devra gérer la liste des étudiant ou pros. 
        $students = []; // Fetch students info from database or service

        // Devra gérer le planning des étudiant ou pros
        $studentPlans = []; //Fetch student plans info from database or service

        return $this->render('admin/index.html.twig', [
            'academyInfo' => $academyInfo,
            'courses' => $courses,
            'students' => $students,
            'studentPlans' => $studentPlans,
        ]);
        
        return $this->render('admin/index.html.twig');
    }

    #[Route('/academy', name: 'admin_manage_academy')]
    public function manageAcademy(): Response
    {
        return $this->render('admin/manage_academy.html.twig');
    }

    #[Route('/courses', name: 'admin_manage_courses')]
    public function manageCourses(): Response
    {
    
        return $this->render('admin/manage_courses.html.twig');
    }

    #[Route('/students', name: 'admin_manage_students')]
    public function manageStudents(): Response
    {

        return $this->render('admin/manage_students.html.twig');
    }

    #[Route('/student_plans', name: 'admin_manage_student_plans')]
    public function manageStudentPlans(): Response
    {

        return $this->render('admin/manage_student_plans.html.twig');
    }

    #[Route('/student/{id}/plan/edit', name: 'admin_edit_student_plan')]
    public function editStudentPlan($id, Request $request): Response
    {
        $studentPlan = $this->entityManager->getRepository(StudentPlan::class)->find($id);

        if (!$studentPlan) {
            throw $this->createNotFoundException('No student plan found for id ' . $id);
        }

        $form = $this->createForm(StudentPlanType::class, $studentPlan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute('admin_manage_student_plans');
        }

        return $this->render('admin/edit_student_plan.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/student/{id}/plan/update', name: 'admin_update_student_plan')]
    public function updateStudentPlan($id, Request $request): Response
    {
        $studentPlan = $this->entityManager->getRepository(StudentPlan::class)->find($id);

        if (!$studentPlan) {
            throw $this->createNotFoundException('No student plan found for id ' . $id);
        }

        $form = $this->createForm(StudentPlanType::class, $studentPlan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute('admin_manage_student_plans');
        }

        return $this->render('admin/edit_student_plan.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}