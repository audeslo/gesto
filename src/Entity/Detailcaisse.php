<?php

namespace App\Entity;

use App\Repository\DetailcaisseRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DetailcaisseRepository::class)
 * @ORM\HasLifecycleCallbacks()
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
     * @ORM\JoinColumn(nullable=false)
     */
    private $agence;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $createdBy;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdOn;

    /**
     * @ORM\PrePersist()
     */
    public function datecreated()
    {
        $this->setCreatedOn(new \DateTime('now'));
    }

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

    public function getCreatedOn(): ?\DateTimeInterface
    {
        return $this->createdOn;
    }

    public function setCreatedOn(\DateTimeInterface $createdOn): self
    {
        $this->createdOn = $createdOn;

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }
}
