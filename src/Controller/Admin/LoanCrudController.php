<?php

namespace App\Controller\Admin;

use App\Entity\Loan;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class LoanCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Loan::class;
    }

    /**
     * A commenter en Dev
     */
    // public function configureActions(Actions $actions): Actions
    // {
    //     // Garder uniquement l'action d'index
    //     return $actions
    //         ->disable(Action::NEW, Action::EDIT, Action::DELETE, Action::DETAIL);
    // }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            numberField::new('materialStock', 'Stock restant')->onlyOnIndex(),
            AssociationField::new('material'),
            AssociationField::new('client'),
        ];
    }
}
