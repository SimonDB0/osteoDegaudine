<?php

namespace App\Controller;

use App\Entity\Post\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class LikeController extends AbstractController
{
    #[Route('/like/post/{id}', name: 'like.post')]
    #[IsGranted('ROLE_USER')]
    public function like(Post $post, EntityManagerInterface $manager): Response
    {
        $user = $this->getUser();
//retiré un like si l'utilisateur a deja liker
        if($post->isLikedByUser($user)){
            $post->removeLike($user);
            $manager->flush();

            return $this->json([
                'message' => 'Le like a été supprimé.',
                'nbLike' => $post->howManyLikes()
            ]);

        }
//Rajoute un like si âs encore de like
        $post->addLike($user);
        $manager->flush();
        return $this->json([
            'message' => 'Le like a été ajouté.',
            'nbLike' => $post->howManyLikes()
        ]);



    }
}
