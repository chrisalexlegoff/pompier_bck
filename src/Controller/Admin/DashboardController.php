<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Loan;
use App\Entity\Material;
use App\Entity\MaterialCat;
use App\Entity\Matricule;
use App\Entity\Product;
use App\Entity\ProductCat;
use App\Entity\Stock;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('admin/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Pompier');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),
            MenuItem::subMenu('Espace membres', 'fas fa-memory')->setSubItems([
                MenuItem::linkToCrud('Membres', 'fas fa-user-astronaut', User::class),
                MenuItem::linkToCrud('Matricules', 'fab fa-creative-commons-nd', Matricule::class),
            ]),
            MenuItem::subMenu('Categories', 'fa fa-list')->setSubItems([
                MenuItem::linkToCrud('Principale', 'fab fa-android', Category::class),
                MenuItem::linkToCrud('Matériels', 'fab fa-avianex', MaterialCat::class),
                MenuItem::linkToCrud('Produits', 'fab fa-black-tie', ProductCat::class),
            ]),
            MenuItem::linkToCrud('Produits', 'fab fa-product-hunt', Product::class),
            MenuItem::linkToCrud('Matériels', 'fab fa-product-hunt', Material::class),
            MenuItem::linkToCrud('Stock', 'fas fa-store', Stock::class),
            MenuItem::linkToCrud('Emprunts', 'fab fa-d-and-d', Loan::class),
        ];
    }
}
