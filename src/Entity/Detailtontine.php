<?php

namespace App\Entity;

use App\Repository\DetailtontineRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DetailtontineRepository::class)
 */
class Detailtontine
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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $mcredit;

    /**
     * @ORM\Column(type="date")
     */
    private $dateope;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numclt;

    /**
     * @ORM\Column(type="smallint")
     */
    private $numlivret;

    /**
     * @ORM\Column(type="smallint")
     */
    private $numordre;

    /**
     * @ORM\Column(type="smallint")
     */
    private $feuillet;

    /**
     * @ORM\ManyToOne(targetEntity=Operation::class, inversedBy="detailtontines")
     * @ORM\JoinColumn(nullable=false)
     */
    private $operation;

    /**
     * @ORM\ManyToOne(targetEntity=Tontine::class, inversedBy="detailtontines")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tontine;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="detailtontines")
     */
    private $client;

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

    public function getMcredit(): ?int
    {
        return $this->mcredit;
    }

    public function setMcredit(?int $mcredit): self
    {
        $this->mcredit = $mcredit;

        return $this;
    }

    public function getDateope(): ?\DateTimeInterface
    {
        return $this->dateope;
    }

    public function setDateope(\DateTimeInterface $dateope): self
    {
        $this->dateope = $dateope;

        return $this;
    }

    public function getNumclt(): ?string
    {
        return $this->numclt;
    }

    public function setNumclt(string $numclt): self
    {
        $this->numclt = $numclt;

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

    public function getNumordre(): ?int
    {
        return $this->numordre;
    }

    public function setNumordre(int $numordre): self
    {
        $this->numordre = $numordre;

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

    public function getOperation(): ?Operation
    {
        return $this->operation;
    }

    public function setOperation(?Operation $operation): self
    {
        $this->operation = $operation;

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

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }
}