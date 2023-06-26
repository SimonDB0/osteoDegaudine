<?php

namespace App\Controller\Admin;

use App\Entity\Post\Category;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeImmutableField;

class CategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Category::class;
    }

    public function configureFields(string $pageName): iterable
    {

            yield TextField::new('name')->setLabel('Name');
            yield SlugField::new('slug')->setTargetFieldName('name');
            yield TextareaField::new('description', 'Description')->hideOnIndex();
            yield AssociationField::new('posts', 'Articles associés')->hideOnForm();

    }
}
