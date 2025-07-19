<?php

namespace App\Entity\Trait;

use App\Enum\Statuses;
use Doctrine\ORM\Mapping as ORM;

trait Status
{
    #[ORM\Column(enumType: Statuses::class, options: ['default' => Statuses::Active])]
    private ?Statuses $status = Statuses::Active;

    public function getStatus(): ?Statuses
    {
        return $this->status;
    }

    public function setStatus(Statuses $status): static
    {
        $this->status = $status;

        return $this;
    }
}
