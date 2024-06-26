<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/about', name: 'about')]
    public function about(): Response
    {
        return $this->render('home/about.html.twig');
    }

    #[Route('/formations', name: 'formations')]
    public function formations(): Response
    {
        return $this->render('home/formations.html.twig');
    }

    #[Route('/history', name: 'history')]
    public function historique(): Response
    {
        return $this->render('home/history.html.twig');
    }

    #[Route('/projects', name: 'projects')]
    public function projects(): Response
    {
        return $this->render('home/projects.html.twig');
    }

    #[Route('/contact', name: 'contact')]
    public function contact(): Response
    {
        return $this->render('contact/index.html.twig');
    }
}
