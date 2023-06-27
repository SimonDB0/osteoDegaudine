<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{

    #[Route('/contact', name: 'contact')]
    public function index(Request $request, MailerInterface $mailer)
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $contactFormData = $form->getData();

            $email = (new Email())
                ->from($contactFormData['email'])
                ->to('contact@estelle-degaudine.be')
                ->subject('Nouveau message de contact sur le site web')
                ->text(
                    'Nom: ' . $contactFormData['name'] .
                    "\n" .
                    'Email: ' . $contactFormData['email'] .
                    "\n" .
                    'Message: ' . $contactFormData['message']
                )
                ->html(
                    '<h1>Nouveau message de contact sur le site web</h1>' .
                    '<p><strong>Nom:</strong> ' . $contactFormData['name'] . '</p>' .
                    '<p><strong>Email:</strong> ' . $contactFormData['email'] . '</p>' .
                    '<p><strong>Message:</strong> ' . $contactFormData['message'] . '</p>'
                );

            try {
                $mailer->send($email);
            } catch (TransportExceptionInterface $e) {

            }

            $this->addFlash('success', 'Votre message a été envoyé. Nous vous répondrons dans les plus brefs délais.');
            return $this->redirectToRoute('app_blog');

        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}