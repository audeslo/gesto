<?php

namespace App\Entity;

use App\Repository\DetailcaisseRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DetailcaisseRepository::class)
 */
class Detailcaisse
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateope;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libope;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $entree;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $sortie;

    /**
     * @ORM\Column(type="integer")
     */
    private $valide;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $typeope;

    /**
     * @ORM\ManyToOne(targetEntity=Agent::class, inversedBy="detailcaisses")
     */
    private $agent;

    /**
     * @ORM\ManyToOne(targetEntity=Agence::class, inversedBy="detailcaisses")
     */
    private $agence;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateope(): ?\DateTimeInterface
    {
        return $this->dateope;
    }

    public function setDateope(?\DateTimeInterface $dateope): self
    {
        $this->dateope = $dateope;

        return $this;
    }

    public function getLibope(): ?string
    {
        return $this->libope;
    }

    public function setLibope(string $libope): self
    {
        $this->libope = $libope;

        return $this;
    }

    public function getEntree(): ?int
    {
        return $this->entree;
    }

    public function setEntree(?int $entree): self
    {
        $this->entree = $entree;

        return $this;
    }

    public function getSortie(): ?int
    {
        return $this->sortie;
    }

    public function setSortie(?int $sortie): self
    {
        $this->sortie = $sortie;

        return $this;
    }

    public function getValide(): ?int
    {
        return $this->valide;
    }

    public function setValide(int $valide): self
    {
        $this->valide = $valide;

        return $this;
    }

    public function getTypeope(): ?string
    {
        return $this->typeope;
    }

    public function setTypeope(?string $typeope): self
    {
        $this->typeope = $typeope;

        return $this;
    }

    public function getAgent(): ?Agent
    {
        return $this->agent;
    }

    public function setAgent(?Agent $agent): self
    {
        $this->agent = $agent;

        return $this;
    }

    public function getAgence(): ?Agence
    {
        return $this->agence;
    }

    public function setAgence(?Agence $agence): self
    {
        $this->agence = $agence;

        return $this;
    }
}
