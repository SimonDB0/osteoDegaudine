<?php

namespace App\Controller\Admin;

use App\Entity\Post\Post;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use App\Entity\Post\Category;
use Vich\UploaderBundle\Form\Type\VichImageType;


class PostCrudController extends AbstractCrudController
{


    public static function getEntityFqcn(): string
    {
        return Post::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Articles')
            ->setEntityLabelInSingular('Article')
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig');
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('title')->setLabel('Titre');
        yield SlugField::new('slug')->setTargetFieldName('title');
        yield TextareaField::new('content')
            ->setFormType(CKEditorType::class)
            ->setLabel('Contenu');
        yield ChoiceField::new('state')->setChoices([
            'Brouillon' => 'STATE_DRAFT',
            'Publié' => 'STATE_PUBLISHED',
            'Archivé' => 'STATE_ARCHIVED',
        ])->setLabel('État');
        yield AssociationField::new('categories')->setLabel('Catégories');
        yield DateTimeField::new('createdAt')
            ->setLabel('Date de création')
            ->setFormat('d/m/Y H:i:s')
            ->hideOnForm();
        yield DateTimeField::new('updatedAt')
            ->setLabel('Date de modification')
            ->setFormat('d/m/Y H:i:s')
            ->hideOnForm();
        yield TextField::new('attachmentFile')->setFormType(VichImageType::class)->onlyWhenCreating();
        yield ImageField::new('attachment') ->setBasePath('/images/posts')->onlyOnIndex();
    }

}
