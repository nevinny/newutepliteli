<?php

namespace App\Controller\Admin;

use App\Entity\Main;
use App\Entity\News;
use App\Entity\Section;
use App\Entity\SectionLink;
use App\Entity\SectionType;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private AdminUrlGenerator $adminUrlGenerator,
        private requestStack $requestStack,
    )
    {}

    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('УТЕПЛИТЕЛИ.org');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section('utepliteli.org');
        yield MenuItem::linkToCrud('Главная', 'fas fa-sitemap', Main::class);
        yield from $this->buildSectionTree();
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);

        yield MenuItem::section('Administration');
        yield MenuItem::linkToCrud('SectionType', 'fas fa-list', SectionType::class);
        yield MenuItem::linkToCrud('SectionLink', 'fas fa-list', SectionLink::class);
        yield MenuItem::section('Пользователи');
        yield MenuItem::linkToCrud('Users', 'fas fa-users', User::class);

        yield MenuItem::linkToRoute('System', 'fas fa-cogs', 'admin_system_index')//            ->setPermission('ROLE_ADMIN')
        ;
    }

    private function buildSectionTree(?Main $parent = null, int $level = 0): iterable
    {
        $currentSectionId = $this->requestStack->getCurrentRequest()?->query->getInt('parent_id');
        $sections = $this->entityManager->getRepository(Main::class)
            ->findBy(['parent' => $parent, 'isNode' => true], ['ord' => 'ASC']);

        foreach ($sections as $section)
        {
            $type = $section->getEntityType();
//            $crudController = $type?->getCrudControllerClass();
            $crudController = MainCrudController::class;
            $entityClass = $type?->getEntityClass();

            $prefix = str_repeat('— ', $level);
            $title = $prefix . $section->getTitle();
            // Выбираем иконку в зависимости от того, является ли раздел текущим
            $icon = ($section->getId() === $currentSectionId)
                ? 'fa fa-folder-open'
                : 'fa fa-folder';
            if ($crudController && $entityClass)
            {
                $url = $this->adminUrlGenerator
                    ->setController($crudController)
                    ->set('parent_id', $section->getId())
                    ->generateUrl();
                yield MenuItem::linkToUrl($title, $icon, $url);
            } else {
                yield MenuItem::linkToCrud($title, $icon, Main::class)
                    ->setQueryParameter('parent_id', $section->getId());
            }

            if ($section->isNode()) {
                yield from $this->buildSectionTree($section, $level + 1);
            }
        }
    }
}
