<?php

namespace App\Service;

use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageUploaderService
{
    public function __construct(
        #[Autowire('%app.upload_dir%')]
        private string $uploadDir,
    ) {}

    public function uploadAndResize(UploadedFile $file, int $thumbSize = 400): array
    {
        $extension = $file->guessExtension() ?? 'jpg';
        $basename = bin2hex(random_bytes(10));
        $originalName = $basename . '.' . $extension;
        $previewName  = $basename . '_thumb.' . $extension;

        $file->move($this->uploadDir, $originalName);

        $this->generateSquareThumbnail(
            $this->uploadDir . '/' . $originalName,
            $this->uploadDir . '/' . $previewName,
            $thumbSize
        );

        return [$originalName, $previewName];
    }

    private function generateSquareThumbnail(string $srcPath, string $destPath, int $thumbSize): void
    {
        [$srcWidth, $srcHeight, $type] = getimagesize($srcPath);

        // Создание ресурса изображения
        switch ($type) {
            case IMAGETYPE_JPEG:
                $srcImage = imagecreatefromjpeg($srcPath);
                break;
            case IMAGETYPE_PNG:
                $srcImage = imagecreatefrompng($srcPath);
                break;
            case IMAGETYPE_WEBP:
                $srcImage = imagecreatefromwebp($srcPath);
                break;
            default:
                throw new \RuntimeException('Unsupported image type');
        }

        // Масштабируем пропорционально по короткой стороне
        $scale = $thumbSize / min($srcWidth, $srcHeight);
        $resizedWidth = (int) round($srcWidth * $scale);
        $resizedHeight = (int) round($srcHeight * $scale);

        $resizedImage = imagecreatetruecolor($resizedWidth, $resizedHeight);
        imagecopyresampled($resizedImage, $srcImage, 0, 0, 0, 0, $resizedWidth, $resizedHeight, $srcWidth, $srcHeight);

        // Обрезаем центр квадрата
        $x = (int) floor(($resizedWidth - $thumbSize) / 2);
        $y = (int) floor(($resizedHeight - $thumbSize) / 2);

        $thumbImage = imagecreatetruecolor($thumbSize, $thumbSize);
        imagecopy($thumbImage, $resizedImage, 0, 0, $x, $y, $thumbSize, $thumbSize);

        // Сохраняем итог
        imagejpeg($thumbImage, $destPath, 85);

        imagedestroy($srcImage);
        imagedestroy($resizedImage);
        imagedestroy($thumbImage);
    }

    private function resizeImage(string $src, string $dest, int $width, int $height): void
    {
        [$origWidth, $origHeight] = getimagesize($src);
        $srcImage = imagecreatefromstring(file_get_contents($src));

        $thumb = imagecreatetruecolor($width, $height);
        imagecopyresampled($thumb, $srcImage, 0, 0, 0, 0, $width, $height, $origWidth, $origHeight);
        imagejpeg($thumb, $dest, 85);
    }
}
