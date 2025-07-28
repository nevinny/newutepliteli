<?php

namespace App\Entity;

use App\Interface\SystemEntityInterface;
use App\Repository\SectionTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SectionTypeRepository::class)]
class SectionType implements SystemEntityInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $code = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $template = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    /**
     * @var Collection<int, Section>
     */
    #[ORM\OneToMany(targetEntity: Section::class, mappedBy: 'type')]
    private Collection $sections;

    #[ORM\Column(options: ['default' => 1])]
    private ?bool $isNode = true;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $entityClass = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $crudControllerClass = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $controllerClass = null;

    public function __construct()
    {
        $this->sections = new ArrayCollection();
    }

    public function __toString(): string
    {
        return (string) $this->code;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getTemplate(): ?string
    {
        return $this->template;
    }

    public function setTemplate(string $template): static
    {
        $this->template = $template;

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

    /**
     * @return Collection<int, Section>
     */
    public function getSections(): Collection
    {
        return $this->sections;
    }

    public function addSection(Section $section): static
    {
        if (!$this->sections->contains($section)) {
            $this->sections->add($section);
            $section->setType($this);
        }

        return $this;
    }

    public function removeSection(Section $section): static
    {
        if ($this->sections->removeElement($section)) {
            // set the owning side to null (unless already changed)
            if ($section->getType() === $this) {
                $section->setType(null);
            }
        }

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

    public function getEntityClass(): ?string
    {
        return $this->entityClass;
    }

    public function setEntityClass(?string $entityClass): static
    {
        $this->entityClass = $entityClass;

        return $this;
    }

    public function getCrudControllerClass(): ?string
    {
        return $this->crudControllerClass;
    }

    public function setCrudControllerClass(?string $crudControllerClass): static
    {
        $this->crudControllerClass = $crudControllerClass;

        return $this;
    }

    public function getControllerClass(): ?string
    {
        return $this->controllerClass;
    }

    public function setControllerClass(?string $controllerClass): static
    {
        $this->controllerClass = $controllerClass;

        return $this;
    }
}
