<?php

namespace App\Controller\Post;

use App\Entity\Post\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/blog/categories')]
class CategoryController extends AbstractController
{
    #[Route('/{slug}', name: 'category.index',methods: ['GET'])]
    public function index(
        Category $category
    ): Response
    {
        return $this->render('category/index.html.twig', [
            'category' => $category,
        ]);
    }
}
