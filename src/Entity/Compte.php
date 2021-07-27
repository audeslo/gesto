<?php

namespace App\Entity;

use App\Repository\CompteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=CompteRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Compte
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $numcomp;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $intitule;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cpcmd;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cpcmc;


    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $solde;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $cpdtder;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datecompt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $derniereop;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $annexo;

    /**
     * @ORM\ManyToOne(targetEntity=Agence::class, inversedBy="comptes")
     */
    private $agence;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="comptes")
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="comptes")
     */
    private $editedBy;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $editedOn;

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
     * @ORM\Column(type="string", length=255)
     * @Gedmo\Slug(fields={"numcomp","intitule"})
     */

    private $slug;

    /**
     * @ORM\OneToMany(targetEntity=Tontine::class, mappedBy="compte")
     */
    private $tontines;

    /**
     * @ORM\Column(type="string", length=32, nullable=true)
     */
    private $type;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $actif;

    /**
     * @ORM\Column(type="string", length=16, nullable=true)
     */
    private $devis;

    /**
     * @ORM\OneToMany(targetEntity=Operation::class, mappedBy="compte")
     */
    private $operations;


    /**
     * @ORM\PrePersist()
     */
    public function datecreated()
    {
        $this->setCreatedOn(new \DateTime('now'));
    }

    /**
     * @ORM\PreUpdate()
     */
    public function dateupdated()
    {
        $this->setEditedOn(new \DateTime('now'));
    }
    public function __construct()
    {
        $this->tontines = new ArrayCollection();
        $this->actif=true;
        $this->operations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumcomp(): ?string
    {
        return $this->numcomp;
    }

    public function setNumcomp(?string $numcomp): self
    {
        $this->numcomp = $numcomp;

        return $this;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(?string $intitule): self
    {
        $this->intitule = $intitule;

        return $this;
    }

    public function getCpcmd(): ?int
    {
        return $this->cpcmd;
    }

    public function setCpcmd(?int $cpcmd): self
    {
        $this->cpcmd = $cpcmd;

        return $this;
    }

    public function getCpcmc(): ?int
    {
        return $this->cpcmc;
    }

    public function setCpcmc(?int $cpcmc): self
    {
        $this->cpcmc = $cpcmc;

        return $this;
    }


    public function getCpdtder(): ?\DateTimeInterface
    {
        return $this->cpdtder;
    }

    public function setCpdtder(?\DateTimeInterface $cpdtder): self
    {
        $this->cpdtder = $cpdtder;

        return $this;
    }

    public function getAnnexo(): ?string
    {
        return $this->annexo;
    }

    public function setAnnexo(?string $annexo): self
    {
        $this->annexo = $annexo;

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

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection|Tontine[]
     */
    public function getTontines(): Collection
    {
        return $this->tontines;
    }

    public function addTontine(Tontine $tontine): self
    {
        if (!$this->tontines->contains($tontine)) {
            $this->tontines[] = $tontine;
            $tontine->setCompte($this);
        }

        return $this;
    }

    public function removeTontine(Tontine $tontine): self
    {
        if ($this->tontines->removeElement($tontine)) {
            // set the owning side to null (unless already changed)
            if ($tontine->getCompte() === $this) {
                $tontine->setCompte(null);
            }
        }

        return $this;
    }

    public function __toString(){
        return $this ->intitule;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(?bool $actif): self
    {
        $this->actif = $actif;

        return $this;
    }

    public function getSolde(): ?int
    {
        return $this->solde;
    }

    public function setSolde(?int $solde): self
    {
        $this->solde = $solde;

        return $this;
    }

    public function getDerniereop(): ?\DateTimeInterface
    {
        return $this->derniereop;
    }

    public function setDerniereop(?\DateTimeInterface $derniereop): self
    {
        $this->derniereop = $derniereop;

        return $this;
    }

    public function getDatecompt(): ?\DateTimeInterface
    {
        return $this->datecompt;
    }

    public function setDatecompt(?\DateTimeInterface $datecompt): self
    {
        $this->datecompt = $datecompt;

        return $this;
    }

    public function getDevis(): ?string
    {
        return $this->devis;
    }

    public function setDevis(?string $devis): self
    {
        $this->devis = $devis;

        return $this;
    }

    /**
     * @return Collection|Operation[]
     */
    public function getOperations(): Collection
    {
        return $this->operations;
    }

    public function addOperation(Operation $operation): self
    {
        if (!$this->operations->contains($operation)) {
            $this->operations[] = $operation;
            $operation->setCompte($this);
        }

        return $this;
    }

    public function removeOperation(Operation $operation): self
    {
        if ($this->operations->removeElement($operation)) {
            // set the owning side to null (unless already changed)
            if ($operation->getCompte() === $this) {
                $operation->setCompte(null);
            }
        }

        return $this;
    }
}
