<?php

namespace App\Controller\Admin;

use App\Entity\Exercice;
use App\Entity\Enum\WeekEnum;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ExerciceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Exercice::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')->onlyOnIndex();
        yield TextField::new('name');
        yield TextField::new('description');
        yield IntegerField::new('duration');
        yield AssociationField::new('program');
        yield TextField::new('session');
        yield ChoiceField::new('week')->setChoices(WeekEnum::cases());
        yield AssociationField::new('users')->onlyOnDetail();
    }
}
