<?php

namespace App\Entity;

use App\Repository\DetailTonRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DetailTonRepository::class)
 */
class DetailTon
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $dateop;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $nordre;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $conserver;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $signature;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $feuillet;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $meconomie;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="client")
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity=Tontine::class, inversedBy="tontine")
     */
    private $tontine;

    /**
     * @ORM\ManyToOne(targetEntity=Agence::class, inversedBy="detailTons")
     */
    private $agence;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateop(): ?\DateTimeInterface
    {
        return $this->dateop;
    }

    public function setDateop(\DateTimeInterface $dateop): self
    {
        $this->dateop = $dateop;

        return $this;
    }

    public function getNordre(): ?int
    {
        return $this->nordre;
    }

    public function setNordre(?int $nordre): self
    {
        $this->nordre = $nordre;

        return $this;
    }

    public function getConserver(): ?int
    {
        return $this->conserver;
    }

    public function setConserver(?int $conserver): self
    {
        $this->conserver = $conserver;

        return $this;
    }

    public function getSignature(): ?string
    {
        return $this->signature;
    }

    public function setSignature(?string $signature): self
    {
        $this->signature = $signature;

        return $this;
    }

    public function getFeuillet(): ?int
    {
        return $this->feuillet;
    }

    public function setFeuillet(?int $feuillet): self
    {
        $this->feuillet = $feuillet;

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
