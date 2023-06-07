<?php

namespace App\Controller\Post;

use App\Entity\Post\Post;
use App\Repository\Post\PostRepository;

use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    #[Route('/blog', name: 'app_blog',methods: ['GET'])]
    public function index(
        PostRepository $postRepository,
        PaginatorInterface $paginatorInterface,
        Request $request
    ): Response{
        $data= $postRepository->findPublished();
        $posts = $paginatorInterface->paginate(
            $data,
            $request->query->getInt('page', 1),

        );
        return $this->render('post/index.html.twig', [
            'posts' => $posts,
        ]);
    }
   #[Route('/blog/article/{slug}',name:'app_blog_show',methods:['GET'])]
    public function show(Post $post,PostRepository $postRepository): Response
    {
        //$post = $postRepository->findOneBy(['slug'=>$post->getSlug()]);
        return $this->render('post/show.html.twig', [
            'post' => $post,
        ]);
    }

}
