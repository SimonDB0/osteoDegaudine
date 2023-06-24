<?php

namespace App\Controller\Admin;

use App\Entity\Post\Thumbnail;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ThumbnailCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Thumbnail::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('imageName', 'Name');

        yield NumberField::new('imageSize', 'Size');

        yield DateTimeField::new('updatedAt')
            ->setDisabled();

        yield AssociationField::new('post');
    }

}
