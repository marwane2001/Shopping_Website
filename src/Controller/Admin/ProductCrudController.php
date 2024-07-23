<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;

    }
public function configureCrud(Crud $crud): Crud
{
    return $crud
        ->setEntityLabelInSingular('Product')
        ->setEntityLabelInPlural('Products')

        ;
}


    public function configureFields(string $pageName): iterable
    {
        $required=true;
        if($pageName='edit'){
            $required=false;
        }
        return [
            TextField::new('name')->setLabel('Title'),
            SlugField::new('slug')->setLabel('Url')->setTargetFieldName('name')->setHelp('The url is generated automatically from the name given'),
            TextEditorField::new('Description')->setLabel('Description')->setHelp('Description of your new product'),
            ImageField::new('Illustration')->setLabel('Image')->setHelp('Add your image with a resolution of 600x600px')->setUploadedFileNamePattern('[year]-[month]-[day]-[contenthash].[extension]')->setBasePath('/upload-dir')->setUploadDir('/public/upload-dir')->setRequired($required),
            NumberField::new('price')->setLabel('Price duty free')->setHelp('Set a price for your product without the $ sign'),
            choiceField::new('tva')->setLabel('Taux de TVA')->setChoices([
                '5,5%'=>'5.5',
                '10%'=>'10%',
                '20%'=>'20%'

            ]),
            AssociationField::new('category','associated category')




        ];
    }

}
