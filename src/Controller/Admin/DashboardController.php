<?php

namespace App\Controller\Admin;

use App\Entity\News;
use App\Entity\Section;
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
//        return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // 1.1) If you have enabled the "pretty URLs" feature:
        // return $this->redirectToRoute('admin_user_index');
        //
        // 1.2) Same example but using the "ugly URLs" that were used in previous EasyAdmin versions:
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirectToRoute('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
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
        yield MenuItem::linkToCrud('Главная', 'fas fa-sitemap', Section::class);
        yield from $this->buildSectionTree();
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);

        yield MenuItem::section('Administration');
        yield MenuItem::linkToCrud('SectionType', 'fas fa-list', SectionType::class);
        yield MenuItem::section('Пользователи');
        yield MenuItem::linkToCrud('Users', 'fas fa-users', User::class);
    }

    private function buildSectionTree(?Section $parent = null, int $level = 0): iterable
    {
        $currentSectionId = $this->requestStack->getCurrentRequest()?->query->getInt('parent_id');
        $sections = $this->entityManager->getRepository(Section::class)
            ->findBy(['parent' => $parent, 'isNode' => true], ['ord' => 'ASC']);

        foreach ($sections as $section)
        {
            $type = $section->getType();
            $crudController = $type?->getCrudControllerClass();
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
                    ->set('parent', $section->getId())
                    ->generateUrl();
                yield MenuItem::linkToUrl($title, $icon, $url);
            } else {
                yield MenuItem::linkToCrud($title, $icon, Section::class)
                    ->setQueryParameter('parent_id', $section->getId());
            }

            if ($section->isNode()) {
                yield from $this->buildSectionTree($section, $level + 1);
            }
        }
    }

    private function buildSectionTreeVSubmenu(?Section $parent = null, int $level = 0): iterable
    {
        $currentSectionId = $this->requestStack->getCurrentRequest()?->query->getInt('parent_id');
        $sections = $this->entityManager->getRepository(Section::class)
            ->findBy(['parent' => $parent, 'isNode' => true], ['ord' => 'ASC']);

        foreach ($sections as $section) {
            $icon = ($section->getId() === $currentSectionId)
                ? 'fa fa-folder-open'
                : 'fa fa-folder';
            $title = str_repeat('— ', $level) . $section->getTitle();

            $type = $section->getType();
            $crudController = $type?->getCrudControllerClass();
            $entityClass = $type?->getEntityClass();

            $url = $crudController && $entityClass
                ? $this->adminUrlGenerator
                    ->setController($crudController)
                    ->set('parent', $section->getId())
                    ->generateUrl()
                : null;

            $link = $url
                ? MenuItem::linkToUrl($title, $icon, $url)
                : MenuItem::linkToCrud($title, $icon, Section::class)
                    ->setQueryParameter('parent_id', $section->getId());

            // получаем дочерние узлы
            $children = $this->entityManager->getRepository(Section::class)
                ->findBy(['parent' => $section, 'isNode' => true], ['ord' => 'ASC']);

            if (!empty($children) && $level < 2) {
                // рекурсивно строим подменю
                $subItems = iterator_to_array($this->buildSectionTree($section, $level + 1));
                yield MenuItem::subMenu($title, $icon)->setSubItems($subItems);
            } else {
                // leaf node (или уровень >= 2) — просто ссылка
                yield $link;
            }
        }
    }



    private function getCrudRouteName(string $crudControllerFqcn): string
    {
        // Получаем короткое имя класса, например NewsCrudController
        $shortClass = (new \ReflectionClass($crudControllerFqcn))->getShortName();

        // Убираем суффикс CrudController
        $baseName = preg_replace('/CrudController$/', '', $shortClass);

        // Переводим CamelCase в snake_case, например News -> news, UserProfile -> user_profile
        $snake = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $baseName));

        // Собираем имя роута — в EasyAdmin по умолчанию: admin_{snake}_index
        return 'admin_' . $snake . '_index';
    }


    private function generateCrudUrl(string $crudController, int $sectionId): string
    {
        return $this->adminUrlGenerator
            ->setController($crudController)
            ->setAction('index')
            ->set('filters[section][comparison]', '=')
            ->set('filters[section][value]', $sectionId)
            ->generateUrl();
    }
}
