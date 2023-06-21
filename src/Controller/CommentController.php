<?php

namespace App\Controller;

use App\Entity\Post\Comment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    #[Route('/blog/article/comment/{id}', name: 'comment.delete')]
    public function delete(Comment $comment, EntityManagerInterface $em, Request $request): Response
    {
        $params = ['slug' => $comment->getPost()->getSlug()];
        if($this->isCsrfTokenValid('delete' . $comment->getId(), $request->request->get('_token'))) {
            $em->remove($comment);
            $em->flush();
        }

        $this->addFlash('success', 'Votre commentaire a bien été supprimé.');

        return $this->redirectToRoute('app_blog_show', $params);
    }
}
