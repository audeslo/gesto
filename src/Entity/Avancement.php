<?php

namespace App\Entity;

use App\Repository\AvancementRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=AvancementRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Avancement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelleavan;

    /**
     * @ORM\Column(type="integer")
     */
    private $montantavan;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateavan;

    /**
     * @ORM\Column(type="integer")
     */
    private $soldecomp;

    /**
     * @ORM\OneToOne(targetEntity=Operation::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $operation;

    /**
     * @ORM\ManyToOne(targetEntity=Agence::class, inversedBy="avancements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $agence;


    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="operations")
     *@ORM\JoinColumn(nullable=false)
     */
    private $createdBy;

    /**
     * @ORM\Column(type="datetime")
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
     * @Gedmo\Slug(fields={"libelleavan","montantavan"})
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="operations")
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity=Tontine::class, inversedBy="avancements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tontine;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $resilier;


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
        $this->dateavan=new \DateTime('now');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleavan(): ?string
    {
        return $this->libelleavan;
    }

    public function setLibelleavan(string $libelleavan): self
    {
        $this->libelleavan = $libelleavan;

        return $this;
    }

    public function getMontantavan(): ?int
    {
        return $this->montantavan;
    }

    public function setMontantavan(int $montantavan): self
    {
        $this->montantavan = $montantavan;

        return $this;
    }

    public function getDateavan(): ?\DateTimeInterface
    {
        return $this->dateavan;
    }

    public function setDateavan(\DateTimeInterface $dateavan): self
    {
        $this->dateavan = $dateavan;

        return $this;
    }

    public function getSoldecomp(): ?int
    {
        return $this->soldecomp;
    }

    public function setSoldecomp(int $soldecomp): self
    {
        $this->soldecomp = $soldecomp;

        return $this;
    }

    public function getOperation(): ?Operation
    {
        return $this->operation;
    }

    public function setOperation(Operation $operation): self
    {
        $this->operation = $operation;

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

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

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

    public function getResilier(): ?bool
    {
        return $this->resilier;
    }

    public function setResilier(?bool $resilier): self
    {
        $this->resilier = $resilier;

        return $this;
    }

}
