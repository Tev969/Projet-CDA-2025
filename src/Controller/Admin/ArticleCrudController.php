<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Enum\StateEnum;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    public function configureFields(string $pageName): iterable
    {
       yield IdField::new('id') -> hideOnForm();
       yield TextField::new('title');
       yield TextEditorField::new('description');
       yield ChoiceField::new('state')->setChoices(StateEnum::cases());
       yield AssociationField::new('categories');
       yield TextField::new('slug');
       yield TextField::new('picture');
       
    }
}
