<?php

namespace App\Entity;

use App\Repository\TontineRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=TontineRepository::class)
 */
class Tontine
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $meconomie;

    /**
     * @ORM\Column(type="smallint")
     */
    private $numordre;

    /**
     * @ORM\Column(type="date")
     */
    private $dateinscr;

    /**
     * @ORM\Column(type="smallint")
     */
    private $numlivret;

    /**
     * @ORM\Column(type="smallint")
     */
    private $nbmois;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numton;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $mcredit;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $remboursement;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $avance;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $interet;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $feuillet;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $finfeuillet;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numcreditencours;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbmaxappoint;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateraappoint;

    /**
     * @ORM\Column(type="string", length=255)
     * @Gedmo\Slug(fields={"feuillet"})
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="tontines")
     */
    private $createdBy;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $createdOn;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="tontines")
     */
    private $editedBy;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $editedOn;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="tontines")
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity=Agence::class, inversedBy="tontines")
     */
    private $agence;

    /**
     * @ORM\ManyToOne(targetEntity=Compte::class, inversedBy="tontines")
     */
    private $compte;


    /**
     * @ORM\PrePersist()
     */
    public function datecreated()
    {
        $this->setCreatedOn(new \DateTime('now'));
      /*  $this->setNomcomplet($this->prenoms.' '.$this->nom);*/
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

    public function getMeconomie(): ?int
    {
        return $this->meconomie;
    }

    public function setMeconomie(int $meconomie): self
    {
        $this->meconomie = $meconomie;

        return $this;
    }

    public function getNumordre(): ?int
    {
        return $this->numordre;
    }

    public function setNumordre(int $numordre): self
    {
        $this->numordre = $numordre;

        return $this;
    }

    public function getDateinscr(): ?\DateTimeInterface
    {
        return $this->dateinscr;
    }

    public function setDateinscr(\DateTimeInterface $dateinscr): self
    {
        $this->dateinscr = $dateinscr;

        return $this;
    }

    public function getNumlivret(): ?int
    {
        return $this->numlivret;
    }

    public function setNumlivret(int $numlivret): self
    {
        $this->numlivret = $numlivret;

        return $this;
    }

    public function getNbmois(): ?int
    {
        return $this->nbmois;
    }

    public function setNbmois(int $nbmois): self
    {
        $this->nbmois = $nbmois;

        return $this;
    }

    public function getNumton(): ?int
    {
        return $this->numton;
    }

    public function setNumton(?int $numton): self
    {
        $this->numton = $numton;

        return $this;
    }

    public function getMcredit(): ?int
    {
        return $this->mcredit;
    }

    public function setMcredit(?int $mcredit): self
    {
        $this->mcredit = $mcredit;

        return $this;
    }

    public function getRemboursement(): ?int
    {
        return $this->remboursement;
    }

    public function setRemboursement(?int $remboursement): self
    {
        $this->remboursement = $remboursement;

        return $this;
    }

    public function getAvance(): ?int
    {
        return $this->avance;
    }

    public function setAvance(?int $avance): self
    {
        $this->avance = $avance;

        return $this;
    }

    public function getInteret(): ?int
    {
        return $this->interet;
    }

    public function setInteret(?int $interet): self
    {
        $this->interet = $interet;

        return $this;
    }

    public function getFeuillet(): ?string
    {
        return $this->feuillet;
    }

    public function setFeuillet(?string $feuillet): self
    {
        $this->feuillet = $feuillet;

        return $this;
    }

    public function getFinfeuillet(): ?string
    {
        return $this->finfeuillet;
    }

    public function setFinfeuillet(?string $finfeuillet): self
    {
        $this->finfeuillet = $finfeuillet;

        return $this;
    }

    public function getNumcreditencours(): ?string
    {
        return $this->numcreditencours;
    }

    public function setNumcreditencours(?string $numcreditencours): self
    {
        $this->numcreditencours = $numcreditencours;

        return $this;
    }

    public function getNbmaxappoint(): ?int
    {
        return $this->nbmaxappoint;
    }

    public function setNbmaxappoint(?int $nbmaxappoint): self
    {
        $this->nbmaxappoint = $nbmaxappoint;

        return $this;
    }

    public function getDateraappoint(): ?\DateTimeInterface
    {
        return $this->dateraappoint;
    }

    public function setDateraappoint(?\DateTimeInterface $dateraappoint): self
    {
        $this->dateraappoint = $dateraappoint;

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

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

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

    public function getCompte(): ?Compte
    {
        return $this->compte;
    }

    public function setCompte(?Compte $compte): self
    {
        $this->compte = $compte;

        return $this;
    }
    public function __toString(){
        return $this ->numlivret;
    }
}
