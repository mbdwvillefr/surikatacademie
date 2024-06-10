<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/profil', name: 'profil')]
    public function profil(): Response
    {
        return $this->render('user/profil.html.twig');
    }

    #[Route('/logout', name: 'logout')]
    public function logout(): Response
    {
        throw new \Exception('This should never be reached!');
    }
}

