<?php

namespace App\Controller\Blog;

use App\Repository\Post\PostRepository;

use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    #[Route('/blog/post', name: 'app_post',methods: ['GET'])]
    public function index(
        PostRepository $postRepository,
        PaginatorInterface $paginatorInterface,
        Request $request
    ): Response
    {
        $data= $postRepository->findPublished();
        $posts = $paginatorInterface->paginate(
            $data,
            $request->query->getInt('page', 1),
            9
        );



        return $this->render('post/index.html.twig', [
            'posts' => $posts,
        ]);
    }
}
