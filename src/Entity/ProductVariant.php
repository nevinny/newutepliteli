<?php

namespace App\Entity;

use App\DataMapper\DefaultParameterMapper;
use App\Entity\Trait\Created;
use App\Entity\Trait\Status;
use App\Interface\ParameterMapperInterface;
use App\Interface\SystemEntityInterface;
use App\Repository\ProductVariantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductVariantRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ORM\UniqueConstraint(
    name: "product_unique_idx",
    columns: ["product_id", "external_id"],
)]
class ProductVariant implements SystemEntityInterface
{
    use Created, Status;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'variants')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Product $product = null;

    #[ORM\Column(length: 255)]
    private ?string $externalId = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $sku = null;

    #[ORM\Column(nullable: true)]
    private ?float $price = null;

    private ?array $cachedSizes = null;

    /**
     * @var Collection<int, ProductParams>
     */
    #[ORM\OneToMany(targetEntity: ProductParams::class, mappedBy: 'variant', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $params;

    /**
     * @var Collection<int, ProductPrice>
     */
    #[ORM\OneToMany(targetEntity: ProductPrice::class, mappedBy: 'variant', orphanRemoval: true)]
    private Collection $prices;

    public function __construct()
    {
        $this->params = new ArrayCollection();
        $this->prices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): static
    {
        $this->product = $product;

        return $this;
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

    public function getSku(): ?string
    {
        return $this->sku;
    }

    public function setSku(?string $sku): static
    {
        $this->sku = $sku;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): static
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection<int, ProductParams>
     */
    public function getParams(): Collection
    {
        return $this->params;
    }

    public function addParam(ProductParams $param): static
    {
        if (!$this->params->contains($param)) {
            $this->params->add($param);
            $param->setVariant($this);
        }

        return $this;
    }

    public function removeParam(ProductParams $param): static
    {
        if ($this->params->removeElement($param)) {
            // set the owning side to null (unless already changed)
            if ($param->getVariant() === $this) {
                $param->setVariant(null);
            }
        }

        return $this;
    }

    public function getSizes(ParameterMapperInterface $mapper = null): array {
        if ($this->cachedSizes !== null) {
            return $this->cachedSizes;
        }

        $mapper = $mapper ?? new DefaultParameterMapper();


        $sizes = [];
        $sizeData = $mapper->getSizeData($this);
        if (!$sizeData) {
            return $sizes;
        }

        $this->cachedSizes = [
            'thickness' => $sizeData['thickness'],
            'size' => $this->formatSize($sizeData['width'], $sizeData['length']),
            'price' => $this->getPrice(),
            'packageQty' => $sizeData['packageQty'] ?? null, // Новое поле
            'inStock' => true, // Можно добавить логику
            'variantId' => $this->getId(),
        ];


        return $sizes;
    }

    private function formatSize(string $width, string $length): string {
        return "$width × $length";
    }

    /**
     * @return Collection<int, ProductPrice>
     */
    public function getPrices(): Collection
    {
        return $this->prices;
    }

    public function addPrice(ProductPrice $price): static
    {
        if (!$this->prices->contains($price)) {
            $this->prices->add($price);
            $price->setVariant($this);
        }

        return $this;
    }

    public function removePrice(ProductPrice $price): static
    {
        if ($this->prices->removeElement($price)) {
            // set the owning side to null (unless already changed)
            if ($price->getVariant() === $this) {
                $price->setVariant(null);
            }
        }

        return $this;
    }
}
