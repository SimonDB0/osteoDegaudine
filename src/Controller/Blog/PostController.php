<?php

namespace App\Controller\Blog;

use App\Repository\Post\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    #[Route('/blog/post', name: 'app_post',methods: ['GET'])]
    public function index(PostRepository $postRepository): Response
    {
        $posts = $postRepository->findPublished();



        return $this->render('post/index.html.twig', [
            'posts' => $posts,
        ]);
    }
}
