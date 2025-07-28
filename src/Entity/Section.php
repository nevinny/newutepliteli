<?php

namespace App\Entity;

use App\Entity\Trait\Created;
use App\Enum\Statuses;
use App\Repository\SectionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SectionRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Section
{
    use Created;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255,unique: true)]
    private ?string $slug = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $metaTitle = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $metaDescription = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $metaKeywords = null;

    #[ORM\Column(type: 'string', length: 255, enumType: Statuses::class)]
    private Statuses $status = Statuses::Active;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'sections')]
    private ?self $parent = null;

    /**
     * @var Collection<int, self>
     */
    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'parent')]
    private Collection $sections;

    #[ORM\ManyToOne(inversedBy: 'sections')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SectionType $type = null;



    #[ORM\Column(length: 255)]
    private ?string $fullPath = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $template = null;

    #[ORM\Column(options: ['default' => '0'])]
    private ?int $ord = 0;

    #[ORM\Column(options: ['default' => 1])]
    private ?bool $isNode = true;

    public function __construct()
    {
        $this->sections = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getMetaTitle(): ?string
    {
        return $this->metaTitle;
    }

    public function setMetaTitle(?string $metaTitle): static
    {
        $this->metaTitle = $metaTitle;

        return $this;
    }

    public function getMetaDescription(): ?string
    {
        return $this->metaDescription;
    }

    public function setMetaDescription(?string $metaDescription): static
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }

    public function getMetaKeywords(): ?string
    {
        return $this->metaKeywords;
    }

    public function setMetaKeywords(?string $metaKeywords): static
    {
        $this->metaKeywords = $metaKeywords;

        return $this;
    }

    public function getStatus(): Statuses
    {
        return $this->status;
    }

    public function setStatus(Statuses $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): static
    {
        $this->parent = $parent;

        return $this;
    }

    public function getLevel(): int
    {
        $level = 0;
        $seen = [$this->getId()]; // массив уже пройденных ID
        $node = $this->getParent();

        while ($node) {
            $id = $node->getId();
            if (!$id || in_array($id, $seen, true)) {
                // защита от цикла
                break;
            }

            $level++;
            $seen[] = $id;
            $node = $node->getParent();
        }

        return $level;
    }

    /**
     * @return Collection<int, self>
     */
    public function getPages(): Collection
    {
        return $this->pages;
    }

    public function addPage(self $page): static
    {
        if (!$this->pages->contains($page)) {
            $this->pages->add($page);
            $page->setParent($this);
        }

        return $this;
    }

    public function removePage(self $page): static
    {
        if ($this->pages->removeElement($page)) {
            // set the owning side to null (unless already changed)
            if ($page->getParent() === $this) {
                $page->setParent(null);
            }
        }

        return $this;
    }

    public function getType(): ?SectionType
    {
        return $this->type;
    }

    public function setType(?SectionType $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getFullPath(): ?string
    {
        return $this->fullPath;
    }

    public function setFullPath(string $fullPath): static
    {
        $this->fullPath = $fullPath;

        return $this;
    }



    public function getTemplate(): ?string
    {
        return $this->template;
    }

    public function setTemplate(?string $template): static
    {
        $this->template = $template;

        return $this;
    }

    public function getOrd(): ?int
    {
        return $this->ord;
    }

    public function setOrd(int $ord): static
    {
        $this->ord = $ord;

        return $this;
    }

    public function isNode(): ?bool
    {
        return $this->isNode;
    }

    public function setIsNode(bool $isNode): static
    {
        $this->isNode = $isNode;

        return $this;
    }
}
