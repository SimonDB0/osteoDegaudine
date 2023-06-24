<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EnergetiqueController extends AbstractController
{
    #[Route('/energetique', name: 'app_energetique')]
    public function index(): Response
    {
        return $this->render('energetique/index.html.twig', [
            'controller_name' => 'EnergetiqueController',
        ]);
    }
}
