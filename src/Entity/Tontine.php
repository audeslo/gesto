<?php

namespace App\Entity;

use App\Repository\TontineRepository;
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
    private $meconomie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numclient;

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

    public function getNumclient(): ?string
    {
        return $this->numclient;
    }

    public function setNumclient(string $numclient): self
    {
        $this->numclient = $numclient;

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
}
