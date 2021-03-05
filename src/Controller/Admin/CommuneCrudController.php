<?php

namespace App\Controller\Admin;

use App\Entity\Commune;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class CommuneCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Commune::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            
            TextField::new('nom'),
            IntegerField::new('population'),
            AssociationField::new('pays')
            // TextEditorField::new('description'),
        ];
    }
    
}
