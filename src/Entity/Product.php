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
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[Vich\Uploadable]
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
    private ?string $anons = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(options: ['default' => '0'])]
    private ?bool $isfp = false;

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

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $preview = null;

    #[Vich\UploadableField(mapping: 'product_preview', fileNameProperty: 'preview')]
    private ?File $previewFile = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[Vich\UploadableField(mapping: 'product_image', fileNameProperty: 'image')]
    private ?File $imageFile = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $specs = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $sizes = null;

    public function __construct(
//        private ParameterGrouper $parameterGrouper
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

    public function getSizes(): ?string
    {
        return $this->sizes;
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

    public function getPreview(): ?string
    {
        return $this->preview;
    }

    public function setPreview(?string $preview): static
    {
        $this->preview = $preview;

        return $this;
    }

    public function getPreviewFile(): ?File
    {
        return $this->previewFile;
    }

    public function setPreviewFile(?File $file = null): void
    {
        $this->previewFile = $file;

        if ($file !== null) {
            $this->updated_at = new \DateTime();
        }
    }


    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $file = null): void
    {
        $this->imageFile = $file;

        if ($file !== null) {
            $this->updated_at = new \DateTime();
        }
    }

    public function getPreviewUrl(): ?string
    {
        if (!$this->preview) {
            return null;
        }

        // если в БД уже полный путь
        if (str_starts_with($this->preview, '/uploads/')) {
            return $this->preview;
        }

        // если только имя
        return '/uploads/products/' . $this->preview;
    }

    public function getImageUrl(): ?string
    {
        if (!$this->imageName) {
            return null;
        }

        // если в БД уже полный путь
        if (str_starts_with($this->imageName, '/uploads/')) {
            return $this->imageName;
        }

        // если только имя
        return '/uploads/products/' . $this->imageName;
    }

    public function getSpecs(): ?string
    {
        return $this->specs;
    }

    public function setSpecs(?string $specs): static
    {
        $this->specs = $specs;

        return $this;
    }

    public function setSizes(?string $sizes): static
    {
        $this->sizes = $sizes;

        return $this;
    }
}
