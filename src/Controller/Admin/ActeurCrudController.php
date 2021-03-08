<?php

namespace App\Controller\Admin;

use App\Entity\Acteur;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ActeurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Acteur::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            IntegerField::new('salaire'),
        ];
    }
    
}
