<?php

namespace App\Controller\Admin;

use App\Entity\Acteur;
use App\Entity\Commune;
use App\Entity\Film;
use App\Entity\Pays;
use App\Entity\User;
use App\Entity\Ville;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Gestion');
            
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Villes', 'fas fa-city', Ville::class);
        yield MenuItem::linkToCrud('Utilisateur', 'fas fa-users', User::class);
        yield MenuItem::linkToCrud('Communes', 'fas fa-truck', Commune::class);
        yield MenuItem::linkToCrud('Pays', 'fas fa-truck', Pays::class);
        yield MenuItem::linkToCrud('Acteurs', 'fas fa-users', Acteur::class);
        yield MenuItem::linkToCrud('Films', 'fas fa-users', Film::class);
    }
}
