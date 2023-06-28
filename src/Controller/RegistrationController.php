<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'account_register')]
    public function register(Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $hasher, MailerInterface $mailer): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hash = $hasher->hashPassword($user, $user->getPassword());
            $user->setPassword($hash);

            // Générer un token de confirmation
            $token = bin2hex(random_bytes(32));
            $user->setConfirmationToken($token);

            $manager->persist($user);
            $manager->flush();

            // Créer le lien de confirmation
            $url = $this->generateUrl('account_confirm', ['token' => $token], UrlGeneratorInterface::ABSOLUTE_URL);

            // Envoyer l'email
            $email = (new Email())
                ->from('contact@estelle-degaudine.be')
                ->to($user->getEmail())
                ->subject('Confirmation de votre compte')
                ->text('Veuillez cliquer sur le lien suivant pour confirmer votre compte : ' . $url);
            $mailer->send($email);

            $this->addFlash(
                'success',
                "Votre compte a bien été créé, veuillez vérifier vos emails pour le confirmer"
            );
//redirection vers le blog
            return $this->redirectToRoute('app_blog');
        }

        return $this->render("registration/register.html.twig", [
            'myform' => $form->createView()
        ]);
    }

    #[Route('/register/confirm/{token}', name: 'account_confirm')]
    public function confirm(string $token, EntityManagerInterface $manager): Response
    {
        $user = $manager->getRepository(User::class)->findOneBy(['confirmationToken' => $token]);

        if ($user === null) {
            $this->addFlash('danger', 'Ce lien de confirmation est invalide.');
            return $this->redirectToRoute('account_register');
        }

        $user->setConfirmationToken(null);
        $user->setConfirmed(true);
        $manager->flush();

        $this->addFlash('success', 'Votre compte a été confirmé, vous pouvez maintenant vous connecter.');

        return $this->redirectToRoute('app_blog');
    }
}
