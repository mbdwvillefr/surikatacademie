<?php
namespace App\Controller;

use App\Entity\Media;
use App\Form\MediaType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MediaController extends AbstractController
{
    #[Route('/media/upload', name: 'media_upload')]
    public function upload(Request $request, EntityManagerInterface $entityManager): Response
    {
        $media = new Media();
        $form = $this->createForm(MediaType::class, $media);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($media);
            $entityManager->flush();

            return $this->redirectToRoute('media_success');
        }

        return $this->render('media/upload.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
