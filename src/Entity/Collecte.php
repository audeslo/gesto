<?php

namespace App\Entity;

use App\Repository\CollecteRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=CollecteRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Collecte
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
    private $libelleclt;

    /**
     * @ORM\Column(type="integer")
     */
    private $montantclt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateclt;

    /**
     * @ORM\OneToOne(targetEntity=Tontine::class, inversedBy="collecte", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $tontine;

    /**
     * @ORM\OneToOne(targetEntity=Operation::class, inversedBy="collecte", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $operation;

    /**
     * @ORM\ManyToOne(targetEntity=Agence::class, inversedBy="collectes")
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
     * @Gedmo\Slug(fields={"libelleclt","montantclt"})
     */
    private $slug;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleclt(): ?string
    {
        return $this->libelleclt;
    }

    public function setLibelleclt(string $libelleclt): self
    {
        $this->libelleclt = $libelleclt;

        return $this;
    }

    public function getMontantclt(): ?int
    {
        return $this->montantclt;
    }

    public function setMontantclt(int $montantclt): self
    {
        $this->montantclt = $montantclt;

        return $this;
    }

    public function getDateclt(): ?\DateTimeInterface
    {
        return $this->dateclt;
    }

    public function setDateclt(\DateTimeInterface $dateclt): self
    {
        $this->dateclt = $dateclt;

        return $this;
    }

    public function getTontine(): ?Tontine
    {
        return $this->tontine;
    }

    public function setTontine(Tontine $tontine): self
    {
        $this->tontine = $tontine;

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
}
