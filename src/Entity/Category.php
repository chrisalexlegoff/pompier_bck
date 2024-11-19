<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    private ?string $name = null;

    /**
     * @var Collection<int, ProductCat>
     */
    #[ORM\OneToMany(targetEntity: ProductCat::class, mappedBy: 'category')]
    private Collection $productCats;

    /**
     * @var Collection<int, MaterialCat>
     */
    #[ORM\OneToMany(targetEntity: MaterialCat::class, mappedBy: 'category')]
    private Collection $materialCats;

    public function __construct()
    {
        $this->productCats = new ArrayCollection();
        $this->materialCats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, ProductCat>
     */
    public function getProductCats(): Collection
    {
        return $this->productCats;
    }

    public function addProductCat(ProductCat $productCat): static
    {
        if (!$this->productCats->contains($productCat)) {
            $this->productCats->add($productCat);
            $productCat->setCategory($this);
        }

        return $this;
    }

    public function removeProductCat(ProductCat $productCat): static
    {
        if ($this->productCats->removeElement($productCat)) {
            // set the owning side to null (unless already changed)
            if ($productCat->getCategory() === $this) {
                $productCat->setCategory(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MaterialCat>
     */
    public function getMaterialCats(): Collection
    {
        return $this->materialCats;
    }

    public function addMaterialCat(MaterialCat $materialCat): static
    {
        if (!$this->materialCats->contains($materialCat)) {
            $this->materialCats->add($materialCat);
            $materialCat->setCategory($this);
        }

        return $this;
    }

    public function removeMaterialCat(MaterialCat $materialCat): static
    {
        if ($this->materialCats->removeElement($materialCat)) {
            // set the owning side to null (unless already changed)
            if ($materialCat->getCategory() === $this) {
                $materialCat->setCategory(null);
            }
        }

        return $this;
    }
    public function __toString(): string
    {
        return $this->name;
    }
}
