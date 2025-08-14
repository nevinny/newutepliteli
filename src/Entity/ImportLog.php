<?php

namespace App\Entity;

use App\Entity\Trait\Created;
use App\Interface\SystemEntityInterface;
use App\Repository\ImportLogRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImportLogRepository::class)]
#[ORM\HasLifecycleCallbacks]
class ImportLog implements SystemEntityInterface
{
    use Created;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $filePath = null;

    #[ORM\Column(nullable: true)]
    private ?int $doneCount = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getFilePath(): ?string
    {
        return $this->filePath;
    }

    public function setFilePath(?string $filePath): static
    {
        $this->filePath = $filePath;

        return $this;
    }

    public function getDoneCount(): ?int
    {
        return $this->doneCount;
    }

    public function setDoneCount(?int $doneCount): static
    {
        $this->doneCount = $doneCount;

        return $this;
    }
}
