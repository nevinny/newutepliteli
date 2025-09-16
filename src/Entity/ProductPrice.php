<?php

namespace App\Entity;

use App\Entity\Trait\Created;
use App\Interface\SystemEntityInterface;
use App\Repository\ProductPriceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductPriceRepository::class)]
#[ORM\UniqueConstraint(
    name: "product_price_unique_idx",
    columns: ["variant_id", "type_id"],
)]
#[ORM\HasLifecycleCallbacks]
class ProductPrice implements SystemEntityInterface
{
    use Created;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'prices')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ProductVariant $variant = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(length: 10)]
    private ?string $currency = 'руб';

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?PriceType $type = null;

    #[ORM\Column(nullable: true)]
    private ?float $coefficient = 1.0;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): static
    {
        $this->currency = $currency;

        return $this;
    }

    public function getType(): ?PriceType
    {
        return $this->type;
    }

    public function setType(?PriceType $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getCoefficient(): ?float
    {
        return $this->coefficient;
    }

    public function setCoefficient(?float $coefficient): static
    {
        $this->coefficient = $coefficient;

        return $this;
    }
}
