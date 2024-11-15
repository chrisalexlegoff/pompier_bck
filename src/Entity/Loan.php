<?php

namespace App\Entity;

use App\Repository\LoanRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LoanRepository::class)]
class Loan
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $loanAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $returnAt = null;

    #[ORM\ManyToOne(inversedBy: 'loans')]
    private ?Material $material = null;

    #[ORM\ManyToOne(inversedBy: 'loans')]
    private ?User $client = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLoanAt(): ?\DateTimeImmutable
    {
        return $this->loanAt;
    }

    public function setLoanAt(\DateTimeImmutable $loanAt): static
    {
        $this->loanAt = $loanAt;

        return $this;
    }

    public function getReturnAt(): ?\DateTimeImmutable
    {
        return $this->returnAt;
    }

    public function setReturnAt(?\DateTimeImmutable $returnAt): static
    {
        $this->returnAt = $returnAt;

        return $this;
    }

    public function getMaterial(): ?Material
    {
        return $this->material;
    }

    public function setMaterial(?Material $material): static
    {
        $this->material = $material;

        return $this;
    }

    public function getClient(): ?User
    {
        return $this->client;
    }

    public function setClient(?User $client): static
    {
        $this->client = $client;

        return $this;
    }
}