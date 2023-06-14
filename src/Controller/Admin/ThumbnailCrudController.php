<?php

namespace App\Controller\Admin;

use App\Entity\Post\Thumbnail;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ThumbnailCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Thumbnail::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
