<?php

namespace App\Entity;

use App\DataMapper\DefaultParameterMapper;
use App\Entity\Trait\Created;
use App\Entity\Trait\DefaultFields;
use App\Entity\Trait\MetaSEO;
use App\Entity\Trait\Status;
use App\Interface\ParameterMapperInterface;
use App\Interface\SystemEntityInterface;
use App\Repository\ProductRepository;
use App\Service\Product\ParameterGrouper;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Product implements SystemEntityInterface
{
    use DefaultFields, MetaSEO, Status, Created;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $externalId = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(nullable: true)]
    private ?float $rating = null;

    #[ORM\Column(options: ['default' => '0'])]
    private ?int $reviewCount = 0;

    private ?array $cachedSizes = null;

    /**
     * @var Collection<int, ProductVariant>
     */
    #[ORM\OneToMany(targetEntity: ProductVariant::class, mappedBy: 'product', cascade: ['persist', 'remove'], orphanRemoval: true)]
    private Collection $variants;

    #[ORM\Column(options: ['default' => '0'])]
    private ?bool $isfp = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $anons = null;

    public function __construct(
        private ParameterGrouper $parameterGrouper
    )
    {
        $this->variants = new ArrayCollection();
    }

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getRating(): ?float
    {
        return $this->rating;
    }

    public function setRating(?float $rating): static
    {
        $this->rating = $rating;

        return $this;
    }

    public function getReviewCount(): ?int
    {
        return $this->reviewCount;
    }

    public function setReviewCount(int $reviewCount): static
    {
        $this->reviewCount = $reviewCount;

        return $this;
    }

    /**
     * @return Collection<int, ProductVariant>
     */
    public function getVariants(): Collection
    {
        return $this->variants;
    }

    public function addVariant(ProductVariant $variant): static
    {
        if (!$this->variants->contains($variant)) {
            $this->variants->add($variant);
            $variant->setProduct($this);
        }

        return $this;
    }

    public function removeVariant(ProductVariant $variant): static
    {
        if ($this->variants->removeElement($variant)) {
            // set the owning side to null (unless already changed)
            if ($variant->getProduct() === $this) {
                $variant->setProduct(null);
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
        foreach ($this->getVariants() as $variant) {
            $sizeData = $mapper->getSizeData($variant);
            if (!$sizeData) {
                continue;
            }

            $sizes[] = [
                'thickness' => $sizeData['thickness'],
                'size' => $this->formatSize($sizeData['width'], $sizeData['length']),
                'price' => $variant->getPrice(),
                'packageQty' => $sizeData['packageQty'] ?? null, // Новое поле
                'inStock' => true, // Можно добавить логику
                'variantId' => $variant->getId(),
            ];
        }
        // Сортировка по толщине (thickness), затем по количеству в упаковке (packageQty)
        usort($sizes, function ($a, $b) {
            // Сначала сравниваем толщину (если строки, преобразуем в числа для правильной сортировки)
            $thicknessA = (float) preg_replace('/[^0-9.]/', '', $a['thickness']);
            $thicknessB = (float) preg_replace('/[^0-9.]/', '', $b['thickness']);

            if ($thicknessA != $thicknessB) {
                return $thicknessA <=> $thicknessB; // Сортировка по возрастанию
            }

            // Если толщина одинаковая, сортируем по количеству в упаковке
            $qtyA = (int) preg_replace('/[^0-9]/', '', $a['packageQty'] ?? '0');
            $qtyB = (int) preg_replace('/[^0-9]/', '', $b['packageQty'] ?? '0');

            return $qtyA <=> $qtyB; // Сортировка по возрастанию
        });

        $this->cachedSizes = $sizes;
        return $sizes;
    }

    private function formatSize(string $width, string $length): string {
        return "$width × $length";
    }

    public function isfp(): ?bool
    {
        return $this->isfp;
    }

    public function setIsfp(bool $isfp): static
    {
        $this->isfp = $isfp;

        return $this;
    }

    public function getAnons(): ?string
    {
        return $this->anons;
    }

    public function setAnons(?string $anons): static
    {
        $this->anons = $anons;

        return $this;
    }
}
