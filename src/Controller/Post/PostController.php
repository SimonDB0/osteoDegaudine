<?php

namespace App\Controller\Post;

use App\Entity\Post\Comment;
use App\Entity\Post\Post;
use App\Form\CommentType;
use App\Repository\Post\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    #[Route('/blog', name: 'app_blog', methods: ['GET'])]
    public function index(
        PostRepository     $postRepository,
        PaginatorInterface $paginatorInterface,
        Request            $request
    ): Response
    {
        $data = $postRepository->findPublished();
        $posts = $paginatorInterface->paginate(
            $data,
            $request->query->getInt('page', 1),

        );
        return $this->render('post/index.html.twig', [
            'posts' => $posts,
        ]);
    }

    #[Route('/blog/article/{slug}', name: 'app_blog_show', methods: ['GET', 'POST'])]
    public function show(Post $post, Request $request, EntityManagerInterface $em): Response
    {
        $comment = new Comment();
        if ($this->getUser()) {
            $comment->setAuthor($this->getUser());
        }
        $comment->setPost($post);

        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($comment);
            $em->flush();

            $this->addFlash('success', 'Votre commentaire a bien été ajouté');

            return $this->redirectToRoute('app_blog_show', [
                'slug' => $post->getSlug()
            ]);
        }

        return $this->render('post/show.html.twig', [
            'post' => $post,
            'form' => $form->createView(),
        ]);
    }


}
