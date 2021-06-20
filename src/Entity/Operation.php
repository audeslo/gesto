<?php

namespace App\Entity;

use App\Repository\OperationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OperationRepository::class)
 */
class Operation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numop;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numpiece;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateop;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $libelleop;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $refpiece;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $montantop;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $genere;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $valide;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datecomptabilisation;

    /**
     * @ORM\ManyToOne(targetEntity=Agence::class, inversedBy="operations")
     */
    private $agence;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="operations")
     */
    private $createdBy;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $createdOn;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="operations")
     */
    private $editedBy;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $editedOn;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="operations")
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity=Tontine::class, inversedBy="operations")
     */
    private $tontine;

    /**
     * @ORM\OneToMany(targetEntity=Detailtontine::class, mappedBy="operation")
     */
    private $detailtontines;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $note;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nomcomplet;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $operant;

    public function __construct()
    {
        $this->detailtontines = new ArrayCollection();
        $this->dateop = new \DateTime('now');
    }

    /**
     * @ORM\PrePersist()
     */
    public function datecreated()
    {
        $this->setCreatedOn(new \DateTime('now'));
        /*   $this->setNomcomplet($this->prenoms.' '.$this->nom);*/
    }

    /**
     * @ORM\PreUpdate()
     */
    public function dateupdated()
    {
        $this->setEditedOn(new \DateTime('now'));
        /* $this->setNomcomplet($this->prenoms.' '.$this->nom);*/
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumop(): ?int
    {
        return $this->numop;
    }

    public function setNumop(?int $numop): self
    {
        $this->numop = $numop;

        return $this;
    }

    public function getNumpiece(): ?int
    {
        return $this->numpiece;
    }

    public function setNumpiece(?int $numpiece): self
    {
        $this->numpiece = $numpiece;

        return $this;
    }

    public function getLibelleop(): ?string
    {
        return $this->libelleop;
    }

    public function setLibelleop(?string $libelleop): self
    {
        $this->libelleop = $libelleop;

        return $this;
    }

    public function getRefpiece(): ?string
    {
        return $this->refpiece;
    }

    public function setRefpiece(?string $refpiece): self
    {
        $this->refpiece = $refpiece;

        return $this;
    }

    public function getMontantop(): ?int
    {
        return $this->montantop;
    }

    public function setMontantop(?int $montantop): self
    {
        $this->montantop = $montantop;

        return $this;
    }

    public function getGenere(): ?int
    {
        return $this->genere;
    }

    public function setGenere(?int $genere): self
    {
        $this->genere = $genere;

        return $this;
    }

    public function getValide(): ?int
    {
        return $this->valide;
    }

    public function setValide(?int $valide): self
    {
        $this->valide = $valide;

        return $this;
    }

    public function getDatecomptabilisation(): ?\DateTimeInterface
    {
        return $this->datecomptabilisation;
    }

    public function setDatecomptabilisation(?\DateTimeInterface $datecomptabilisation): self
    {
        $this->datecomptabilisation = $datecomptabilisation;

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

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getCreatedOn(): ?\DateTimeInterface
    {
        return $this->createdOn;
    }

    public function setCreatedOn(?\DateTimeInterface $createdOn): self
    {
        $this->createdOn = $createdOn;

        return $this;
    }

    public function getEditedBy(): ?User
    {
        return $this->editedBy;
    }

    public function setEditedBy(?User $editedBy): self
    {
        $this->editedBy = $editedBy;

        return $this;
    }

    public function getEditedOn(): ?\DateTimeInterface
    {
        return $this->editedOn;
    }

    public function setEditedOn(?\DateTimeInterface $editedOn): self
    {
        $this->editedOn = $editedOn;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getTontine(): ?Tontine
    {
        return $this->tontine;
    }

    public function setTontine(?Tontine $tontine): self
    {
        $this->tontine = $tontine;

        return $this;
    }

    public function __toString(){
        return $this ->libelleop;
    }

    /**
     * @return Collection|Detailtontine[]
     */
    public function getDetailtontines(): Collection
    {
        return $this->detailtontines;
    }

    public function addDetailtontine(Detailtontine $detailtontine): self
    {
        if (!$this->detailtontines->contains($detailtontine)) {
            $this->detailtontines[] = $detailtontine;
            $detailtontine->setOperation($this);
        }

        return $this;
    }

    public function removeDetailtontine(Detailtontine $detailtontine): self
    {
        if ($this->detailtontines->removeElement($detailtontine)) {
            // set the owning side to null (unless already changed)
            if ($detailtontine->getOperation() === $this) {
                $detailtontine->setOperation(null);
            }
        }

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getNomcomplet(): ?string
    {
        return $this->nomcomplet;
    }

    public function setNomcomplet(?string $nomcomplet): self
    {
        $this->nomcomplet = $nomcomplet;

        return $this;
    }

    public function getOperant(): ?string
    {
        return $this->operant;
    }

    public function setOperant(?string $operant): self
    {
        $this->operant = $operant;

        return $this;
    }

    public function getDateop(): ?\DateTimeInterface
    {
        return $this->dateop;
    }

    public function setDateop(?\DateTimeInterface $dateop): self
    {
        $this->dateop = $dateop;

        return $this;
    }

}
