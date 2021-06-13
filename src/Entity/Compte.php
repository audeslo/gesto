<?php

namespace App\Entity;

use App\Repository\CompteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=CompteRepository::class)
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
     * @ORM\Column(type="integer")
     */
    private $cpasld;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cpasldj;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cpnbmvt;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $cpdtder;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $mdate;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $mheure;

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
     */
    private $createdBy;

    /**
     * @ORM\Column(type="datetime", nullable=true)
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
    public function __construct()
    {
        $this->tontines = new ArrayCollection();
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

    public function getCpasld(): ?int
    {
        return $this->cpasld;
    }

    public function setCpasld(int $cpasld): self
    {
        $this->cpasld = $cpasld;

        return $this;
    }

    public function getCpasldj(): ?int
    {
        return $this->cpasldj;
    }

    public function setCpasldj(?int $cpasldj): self
    {
        $this->cpasldj = $cpasldj;

        return $this;
    }

    public function getCpnbmvt(): ?int
    {
        return $this->cpnbmvt;
    }

    public function setCpnbmvt(?int $cpnbmvt): self
    {
        $this->cpnbmvt = $cpnbmvt;

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

    public function getMdate(): ?\DateTimeInterface
    {
        return $this->mdate;
    }

    public function setMdate(?\DateTimeInterface $mdate): self
    {
        $this->mdate = $mdate;

        return $this;
    }

    public function getMheure(): ?\DateTimeInterface
    {
        return $this->mheure;
    }

    public function setMheure(?\DateTimeInterface $mheure): self
    {
        $this->mheure = $mheure;

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
}
