<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ThankYouController extends AbstractController
{
    #[Route('/thank_you', name: 'thank_you')]
    public function index(): Response
    {
        return $this->render('thank_you/index.html.twig', [
            'controller_name' => 'ThankYouController',
        ]);
    }
}
