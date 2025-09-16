<?php

namespace App\Entity;

use App\Entity\Trait\Created;
use App\Entity\Trait\DefaultFields;
use App\Entity\Trait\Status;
use App\Repository\WarehouseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WarehouseRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Warehouse
{
    use DefaultFields, Created, Status;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $externalId = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $address = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExternalId(): ?string
    {
        return $this->externalId;
    }

    public function setExternalId(string $externalId): static
    {
        $this->externalId = $externalId;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): static
    {
        $this->address = $address;

        return $this;
    }
}
