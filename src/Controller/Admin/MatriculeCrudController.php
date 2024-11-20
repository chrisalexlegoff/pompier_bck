<?php

namespace App\Controller\Admin;

use App\Entity\Matricule;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MatriculeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Matricule::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('matricule'),
            AssociationField::new('client'),
        ];
    }
}
