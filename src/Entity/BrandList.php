<?php

namespace App\Entity;

use App\Entity\Trait\Created;
use App\Entity\Trait\DefaultFields;
use App\Entity\Trait\MetaSEO;
use App\Entity\Trait\Status;
use App\Repository\BrandListRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BrandListRepository::class)]
#[ORM\HasLifecycleCallbacks]
class BrandList
{
    use DefaultFields, MetaSEO, Status, Created;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }
}
