<?php

namespace App\Controller\Admin;

use App\Entity\Header;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class HeaderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Header::class;
    }


    public function configureFields(string $pageName): iterable
    {
        $required = true;

        if ($pageName == 'edit') {
            $required = false;
        }

        return [
            TextField::new('title', 'Title'),
            TextareaField::new('context', 'Content'),
            TextField::new('buttonTitle', 'Button Title'),
            TextField::new('buttonLink', 'Button Link'),
            ImageField::new('illustration')
                ->setLabel('Header background image')
                ->setHelp('Header background image')
                ->setUploadedFileNamePattern('[year]-[month]-[day]-[contenthash].[extension]')
                ->setBasePath('/upload-dir')
                ->setUploadDir('/public/upload-dir')
                ->setRequired($required)
        ];
    }


}
