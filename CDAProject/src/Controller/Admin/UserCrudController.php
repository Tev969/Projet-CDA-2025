<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id') -> hideOnForm();
        yield TextField::new('firstname');
        yield TextField::new('lastname');
        yield TextField::new('email');
        yield ArrayField::new('roles');
        yield TextField::new('password') -> onlyOnForms();
        yield TextField::new('sexe');
        yield TextField::new('size');
        yield TextField::new('weight');
        yield TextField::new('level');
        yield TextField::new('week_activity');
    }
    
}
