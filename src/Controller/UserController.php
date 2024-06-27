<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user/profile', name: 'user_profile')]
    public function profile(): Response
    {
        return $this->render('user/profile/index.html.twig');
    }

    #[Route('/user/settings', name: 'user_settings')]
    public function settings(): Response
    {
        return $this->render('user/settings/index.html.twig');
    }

    #[Route('/user/sign_out', name: 'user_sign_out')]
    public function signOut(): Response
    {
        // Add logic here for signing out if needed
        return $this->redirectToRoute('home'); 
    }
}
