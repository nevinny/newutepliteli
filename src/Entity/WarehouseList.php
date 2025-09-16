<?php

namespace App\Entity;

use App\Entity\Trait\Created;
use App\Entity\Trait\DefaultFields;
use App\Entity\Trait\MetaSEO;
use App\Entity\Trait\Status;
use App\Repository\WarehouseListRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WarehouseListRepository::class)]
class WarehouseList
{
    use DefaultFields, MetaSEO, Status, Created;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}
