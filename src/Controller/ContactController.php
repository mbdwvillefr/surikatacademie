<?php
//ContactController 将处理与联系表单相关的请求，例如显示表单和处理提交的表单。
namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function sendEmail(
        Request $request, 
        MailerInterface $mailer
    ): Response {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $email = (new Email())
                ->from($form->get('email')->getData())
                ->to('lisa.botellafr@gmail.com')
                ->subject($form->get('subject')->getData())
                ->text($form->get('message')->getData());

            try {
                $mailer->send($email);
                $this->addFlash(
                    'success',
                    'Your message was sent successfully!'
                );
                 // 处理完发送邮件后的逻辑，比如重定向或者显示感谢信息
                 return $this->redirectToRoute('thank_you');
            } catch (TransportExceptionInterface $error) {
                $this->addFlash(
                    'error',
                    'Failed to send email: ' . $error->getMessage()
                );
            }
        }
        // 如果不是POST请求，则渲染联系页面
        return $this->render('contact/index.html.twig', [
            // 'form' => $form,
            'form' => $form->createView(),
        ]);
    }
}
