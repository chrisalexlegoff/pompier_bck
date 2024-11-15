<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 25)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column]
    private ?float $unitaryPrice = null;

    /**
     * @var Collection<int, Command>
     */
    #[ORM\ManyToMany(targetEntity: Command::class, inversedBy: 'products')]
    private Collection $commands;

    #[ORM\ManyToOne(inversedBy: 'produits')]
    private ?ProductCat $productCat = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    private ?Stock $stock = null;

    public function __construct()
    {
        $this->commands = new ArrayCollection();
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    public function getUnitaryPrice(): ?float
    {
        return $this->unitaryPrice;
    }

    public function setUnitaryPrice(float $unitaryPrice): static
    {
        $this->unitaryPrice = $unitaryPrice;

        return $this;
    }

    /**
     * @return Collection<int, Command>
     */
    public function getCommand(): Collection
    {
        return $this->commands;
    }

    public function addCommand(Command $command): static
    {
        if (!$this->commands->contains($command)) {
            $this->commands->add($command);
        }

        return $this;
    }

    public function removeCommand(Command $command): static
    {
        $this->commands->removeElement($command);

        return $this;
    }

    public function getProductCat(): ?ProductCat
    {
        return $this->productCat;
    }

    public function setProductCat(?ProductCat $productCat): static
    {
        $this->productCat = $productCat;

        return $this;
    }

    public function getStock(): ?Stock
    {
        return $this->stock;
    }

    public function setStock(?Stock $stock): static
    {
        $this->stock = $stock;

        return $this;
    }
}
