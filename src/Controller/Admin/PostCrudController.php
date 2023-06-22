<?php

namespace App\Controller\Admin;

use App\Entity\Post\Post;
use App\Entity\Post\Category;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class PostCrudController extends AbstractCrudController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

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
        yield IdField::new('id');
        yield TextField::new('title');
        yield TextField::new('slug');
        yield TextareaField::new('content')
            ->setFormType(CKEditorType::class);
        yield ChoiceField::new('state')->setChoices([
            'Draft' => 'STATE_DRAFT',
            'Published' => 'STATE_PUBLISHED',
            'Archived' => 'STATE_ARCHIVED',
        ]);
        yield AssociationField::new('categories');
        yield DateTimeField::new('createdAt')
            ->setLabel('Date de création')
            ->setFormat('d/m/Y H:i:s')
            ->hideOnForm();
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        // Récupérer les nouvelles catégories ajoutées
        $categories = $entityInstance->getCategories();

        // Parcourir les catégories et les persister si elles n'ont pas d'identifiant
        foreach ($categories as $category) {
            if (!$category->getId()) {
                $entityManager->persist($category);
            }
        }

        parent::persistEntity($entityManager, $entityInstance);
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        // Récupérer les nouvelles catégories ajoutées
        $categories = $entityInstance->getCategories();

        // Parcourir les catégories et les persister si elles n'ont pas d'identifiant
        foreach ($categories as $category) {
            if (!$category->getId()) {
                $entityManager->persist($category);
            }
        }

        parent::updateEntity($entityManager, $entityInstance);
    }
}
