<?php

namespace App\Entity;

use App\Entity\Trait\Created;
use App\Enum\CartStatus;
use App\Interface\SystemEntityInterface;
use App\Repository\CartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CartRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Cart implements SystemEntityInterface
{
    use Created;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'carts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    /**
     * @var Collection<int, CartItem>
     */
    #[ORM\OneToMany(targetEntity: CartItem::class, mappedBy: 'cart', cascade: ['persist'], orphanRemoval: true)]
    private Collection $items;

    #[ORM\Column(type: 'string', enumType: CartStatus::class, options: ['default' => CartStatus::Active])]
    private ?CartStatus $status = CartStatus::Active;



    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    public function __toString(): string
    {
        return sprintf('Cart #%d (User ID: %d)', $this->id ?? 0, $this->getUser()?->getId() ?? 0);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getTotal(): float
    {
        $total = 0.0;
        foreach ($this->items as $item) {
            $total += $item->getVariant()->getPrice() * $item->getQuantity();
        }
        return $total;
    }

    /**
     * @return Collection<int, CartItem>
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function getItemByVariant(ProductVariant $variant): ?CartItem
    {
        foreach ($this->items as $item) {
            if ($item->getVariant()->getId() === $variant->getId()) {
                return $item;
            }
        }
        return null;
    }

    public function updateItemQuantity(ProductVariant $variant, int $quantity): void
    {
        $item = $this->getItemByVariant($variant);
        if ($item) {
            if ($quantity <= 0) {
                $this->removeItem($item);
            } else {
                $item->setQuantity($quantity);
            }
        } elseif ($quantity > 0) {
            $this->addItem(new CartItem($this, $variant, $quantity));
        }
    }


    public function addItem(CartItem $item): static
    {
        if (!$this->items->contains($item)) {
            $this->items->add($item);
            $item->setCart($this);
        }

        return $this;
    }


    public function removeItem(CartItem $item): static
    {
        if ($this->items->removeElement($item)) {
            // set the owning side to null (unless already changed)
            if ($item->getCart() === $this) {
                $item->setCart(null);
            }
        }

        return $this;
    }

    public function hasItem(int $variantId): bool
    {
        foreach ($this->items as $item) {
            if ($item->getVariant()->getId() === $variantId) {
                return true;
            }
        }
        return false;
    }

//    public function removeItemByVariantId(int $variantId): void
//    {
//        $item = $this->getItemByVariantId($variantId);
//        if ($item) {
//            $this->items->removeElement($item);
//        }
//    }

    public function clear(): void
    {
        $this->items->clear();
    }

    public function getStatus(): CartStatus|string|null
    {
        return $this->status;
    }

    public function setStatus(CartStatus $status): static
    {
        $this->status = $status;

        return $this;
    }
}
