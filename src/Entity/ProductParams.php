<?php

namespace App\Entity;

use App\Entity\Trait\Created;
use App\Entity\Trait\Status;
use App\Interface\SystemEntityInterface;
use App\Repository\ProductParamsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductParamsRepository::class)]
#[ORM\UniqueConstraint(
    name: "product_variants_unique_idx",
    columns: ["variant_id", "external_id"],
)]
#[ORM\HasLifecycleCallbacks]
class ProductParams implements SystemEntityInterface
{
    use Created, Status;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $externalId = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $title = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $val = null;

    #[ORM\ManyToOne(inversedBy: 'params')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ProductVariant $variant = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExternalId(): ?string
    {
        return $this->externalId;
    }

    public function setExternalId(?string $externalId): static
    {
        $this->externalId = $externalId;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = trim($title);

        return $this;
    }

    public function getVal(): ?string
    {
        return $this->val;
    }

    public function setVal(?string $val): static
    {
        $this->val = trim($val);

        return $this;
    }

    public function getVariant(): ?ProductVariant
    {
        return $this->variant;
    }

    public function setVariant(?ProductVariant $variant): static
    {
        $this->variant = $variant;

        return $this;
    }
}
