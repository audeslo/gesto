<?php

namespace App\Entity;

use App\Repository\TontineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

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
    private $toncliunik;


    /**
     * @ORM\Column(type="smallint")
     */
    private $nlivr;

    /**
     * @ORM\Column(type="smallint")
     */
    private $nordre;

    /**
     * @ORM\Column(type="smallint")
     */
    private $feuillet;

    /**
     * @ORM\Column(type="smallint")
     */
    private $finfeuillet;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $meconomie;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateins;

    /**
     * @ORM\ManyToOne(targetEntity=Agence::class, inversedBy="agence")
     */
    private $agence;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="client")
     */
    private $client;

    /**
     * @ORM\OneToMany(targetEntity=DetailTon::class, mappedBy="tontine")
     */
    private $tontine;

    public function __construct()
    {
        $this->tontine = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getToncliunik(): ?int
    {
        return $this->toncliunik;
    }

    public function setToncliunik(int $toncliunik): self
    {
        $this->toncliunik = $toncliunik;

        return $this;
    }

    public function getNlivr(): ?int
    {
        return $this->nlivr;
    }

    public function setNlivr(int $nlivr): self
    {
        $this->nlivr = $nlivr;

        return $this;
    }

    public function getNordre(): ?int
    {
        return $this->nordre;
    }

    public function setNordre(int $nordre): self
    {
        $this->nordre = $nordre;

        return $this;
    }

    public function getFeuillet(): ?int
    {
        return $this->feuillet;
    }

    public function setFeuillet(int $feuillet): self
    {
        $this->feuillet = $feuillet;

        return $this;
    }

    public function getFinfeuillet(): ?int
    {
        return $this->finfeuillet;
    }

    public function setFinfeuillet(int $finfeuillet): self
    {
        $this->finfeuillet = $finfeuillet;

        return $this;
    }

    public function getMeconomie(): ?int
    {
        return $this->meconomie;
    }

    public function setMeconomie(?int $meconomie): self
    {
        $this->meconomie = $meconomie;

        return $this;
    }

    public function getDateins(): ?\DateTimeInterface
    {
        return $this->dateins;
    }

    public function setDateins(?\DateTimeInterface $dateins): self
    {
        $this->dateins = $dateins;

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

    /**
     * @return Collection|DetailTon[]
     */
    public function getTontine(): Collection
    {
        return $this->tontine;
    }

    public function addTontine(DetailTon $tontine): self
    {
        if (!$this->tontine->contains($tontine)) {
            $this->tontine[] = $tontine;
            $tontine->setTontine($this);
        }

        return $this;
    }

    public function removeTontine(DetailTon $tontine): self
    {
        if ($this->tontine->removeElement($tontine)) {
            // set the owning side to null (unless already changed)
            if ($tontine->getTontine() === $this) {
                $tontine->setTontine(null);
            }
        }

        return $this;
    }


}
