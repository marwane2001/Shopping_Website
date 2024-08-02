<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('user')
            ->setEntityLabelInPlural('users');
    }

    public function configureFields(string $pageName): iterable
    {
        $roles = ['ROLE_USER' => 'ROLE_USER', 'ROLE_ADMIN' => 'ROLE_ADMIN']; // Adjust according to your roles

        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('firstname'),
            TextField::new('lastname'),
            TextField::new('email')->onlyOnIndex(),
            ChoiceField::new('roles')
                ->allowMultipleChoices()
                ->setChoices($roles)
                ->setHelp('Select roles for the user.')
        ];
    }
}
