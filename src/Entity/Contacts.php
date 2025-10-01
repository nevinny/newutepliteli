<?php

namespace App\Entity;

use App\Entity\Trait\Created;
use App\Entity\Trait\DefaultFields;
use App\Entity\Trait\MetaSEO;
use App\Entity\Trait\Status;
use App\Repository\ContactsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContactsRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Contacts
{
    use DefaultFields, MetaSEO, Status, Created;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $addr = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $phone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $workHours = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $coordinates = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $storeAddr = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $storePhone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $storeEmail = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $storeWorkHours = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $storeCoordinates = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddr(): ?string
    {
        return $this->addr;
    }

    public function setAddr(?string $addr): static
    {
        $this->addr = $addr;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getWorkHours(): ?string
    {
        return $this->workHours;
    }

    public function setWorkHours(?string $workHours): static
    {
        $this->workHours = $workHours;

        return $this;
    }

    public function getCoordinates(): ?string
    {
        return $this->coordinates;
    }

    public function setCoordinates(?string $coordinates): static
    {
        $this->coordinates = $coordinates;

        return $this;
    }

    public function getStoreAddr(): ?string
    {
        return $this->storeAddr;
    }

    public function setStoreAddr(?string $storeAddr): static
    {
        $this->storeAddr = $storeAddr;

        return $this;
    }

    public function getStorePhone(): ?string
    {
        return $this->storePhone;
    }

    public function setStorePhone(?string $storePhone): static
    {
        $this->storePhone = $storePhone;

        return $this;
    }

    public function getStoreEmail(): ?string
    {
        return $this->storeEmail;
    }

    public function setStoreEmail(?string $storeEmail): static
    {
        $this->storeEmail = $storeEmail;

        return $this;
    }

    public function getStoreWorkHours(): ?string
    {
        return $this->storeWorkHours;
    }

    public function setStoreWorkHours(?string $storeWorkHours): static
    {
        $this->storeWorkHours = $storeWorkHours;

        return $this;
    }

    public function getStoreCoordinates(): ?string
    {
        return $this->storeCoordinates;
    }

    public function setStoreCoordinates(?string $storeCoordinates): static
    {
        $this->storeCoordinates = $storeCoordinates;

        return $this;
    }
}
