<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{

    #[Route('/connexion', name: 'security.login')]
    public function login(AuthenticationUtils $utils): Response
    {
        // recupere l'erreur si il y en a une
        $error = $utils->getLastAuthenticationError();
        $lastUsername = $utils->getLastUsername();

        return $this->render('security/login.html.twig',
            [
                'error' => $error !== null,
                'last_username' => $lastUsername
            ]
        );
    }
#[Route('/deconnexion', name: 'security.logout',methods: ['GET'])]
    public function logout() : void
    {
        // rien
    }
}
