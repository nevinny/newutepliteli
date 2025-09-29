<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Symfony\Component\HttpFoundation\JsonResponse;

class SystemController extends AbstractController
{
    #[Route('/admin/system', name: 'admin_system_index', priority: 500)]
    public function index(): Response
    {
        return $this->render('admin/system/index.html.twig');
    }

    #[Route('/admin/system/clear-cache', name: 'admin_system_clear_cache', methods: ['GET', 'POST'])]
    public function clearCache(): JsonResponse
    {
        try {
            $process = new Process(['php', 'bin/console', 'cache:clear']);
            $process->setWorkingDirectory($this->getParameter('kernel.project_dir'));
            $process->setTimeout(300); // 5 минут таймаут

            $process->run();

            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            return new JsonResponse([
                'success' => true,
                'message' => 'Кеш успешно очищен',
                'output' => $process->getOutput()
            ]);

        } catch (ProcessFailedException $exception) {
            return new JsonResponse([
                'success' => false,
                'message' => 'Ошибка при очистке кеша',
                'error' => $exception->getMessage()
            ], 500);
        }
    }

    #[Route('/admin/system/backup', name: 'admin_system_backup', methods: ['POST'])]
    public function createBackup(): JsonResponse
    {
        try {
            $backupScript = $this->getParameter('kernel.project_dir') . '/backup.sh';

            if (!file_exists($backupScript)) {
                return new JsonResponse([
                    'success' => false,
                    'message' => 'Файл backup.sh не найден'
                ], 404);
            }

            if (!is_executable($backupScript)) {
                return new JsonResponse([
                    'success' => false,
                    'message' => 'Файл backup.sh не является исполняемым'
                ], 500);
            }

            $process = new Process(['./backup.sh']);
            $process->setWorkingDirectory($this->getParameter('kernel.project_dir'));
            $process->setTimeout(600); // 10 минут таймаут для бэкапа

            $process->run();

            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            return new JsonResponse([
                'success' => true,
                'message' => 'Бэкап успешно создан',
                'output' => $process->getOutput()
            ]);

        } catch (ProcessFailedException $exception) {
            return new JsonResponse([
                'success' => false,
                'message' => 'Ошибка при создании бэкапа',
                'error' => $exception->getMessage()
            ], 500);
        }
    }
}
