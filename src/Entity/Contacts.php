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
}
