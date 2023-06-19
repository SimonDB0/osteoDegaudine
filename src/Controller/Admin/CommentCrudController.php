<?php

namespace App\Controller\Admin;

use App\Entity\Post\Comment;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CommentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Comment::class;
    }


    public function configureFields(string $pageName): iterable
    {
       yield TextField::new('content', 'Contenu');
       yield TextField::new('author', 'Auteur');
    }

}
