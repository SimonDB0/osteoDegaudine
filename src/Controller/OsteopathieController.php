<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OsteopathieController extends AbstractController
{
    #[Route('/osteopathie', name: 'app_osteopathie')]
    public function index(): Response
    {
        return $this->render('osteopathie/index.html.twig', [
            'controller_name' => 'OsteopathieController',
        ]);
    }
}
