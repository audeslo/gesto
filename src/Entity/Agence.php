<?php

namespace App\Entity;

use App\Repository\AgenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AgenceRepository::class)
 */
class Agence
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
    private $codeagence;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity=Tontine::class, mappedBy="agence")
     */
    private $agence;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity=DetailTon::class, mappedBy="agence")
     */
    private $detailTons;

    public function __construct()
    {
        $this->agence = new ArrayCollection();
        $this->detailTons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeagence(): ?string
    {
        return $this->codeagence;
    }

    public function setCodeagence(string $codeagence): self
    {
        $this->codeagence = $codeagence;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|Tontine[]
     */
    public function getAgence(): Collection
    {
        return $this->agence;
    }

    public function addAgence(Tontine $agence): self
    {
        if (!$this->agence->contains($agence)) {
            $this->agence[] = $agence;
            $agence->setAgence($this);
        }

        return $this;
    }

    public function removeAgence(Tontine $agence): self
    {
        if ($this->agence->removeElement($agence)) {
            // set the owning side to null (unless already changed)
            if ($agence->getAgence() === $this) {
                $agence->setAgence(null);
            }
        }

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection|DetailTon[]
     */
    public function getDetailTons(): Collection
    {
        return $this->detailTons;
    }

    public function addDetailTon(DetailTon $detailTon): self
    {
        if (!$this->detailTons->contains($detailTon)) {
            $this->detailTons[] = $detailTon;
            $detailTon->setAgence($this);
        }

        return $this;
    }

    public function removeDetailTon(DetailTon $detailTon): self
    {
        if ($this->detailTons->removeElement($detailTon)) {
            // set the owning side to null (unless already changed)
            if ($detailTon->getAgence() === $this) {
                $detailTon->setAgence(null);
            }
        }

        return $this;
    }
}
