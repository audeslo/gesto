<?php

namespace App\Entity;

use App\Repository\TontineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=TontineRepository::class)
 * @ORM\Table (
 *     name="tontine",
 *      uniqueConstraints={@ORM\UniqueConstraint(columns={"numcomp", "ranglivret"})}
 * )
 * @ORM\HasLifecycleCallbacks()
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
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $numordre;

    /**
     * @ORM\Column(type="date" , nullable=true)
     */
    private $dateinscr;

    /**
     * @ORM\Column(type="integer")
     */
    private $ranglivret;

    /**
     * @ORM\Column(type="string")
     */
    private $reflivret;

    /**
     * @ORM\Column(type="smallint", nullable=true))
     */
    private $nbmois;


    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $mcredit;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $mdebit;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $avance;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbfeuillet;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $finfeuillet;


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
     * @Gedmo\Slug(fields={"reflivret","ranglivret","nbfeuillet","nbmaxappoint"})
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="tontines")
     * @ORM\JoinColumn(nullable=false)
     */
    private $createdBy;

    /**
     * @ORM\Column(type="date")
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
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity=Agence::class, inversedBy="tontines")
     * @ORM\JoinColumn(nullable=false)
     */
    private $agence;

    /**
     * @ORM\ManyToOne(targetEntity=Compte::class, inversedBy="tontines")
     * @ORM\JoinColumn(nullable=false)
     */
    private $compte;

    /**
     * @ORM\OneToMany(targetEntity=Operation::class, mappedBy="tontine")
     */
    private $operations;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Note;

    /**
     * @ORM\Column(type="boolean")
     */
    private $actif;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $bloqueravance;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $feuillet;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $numcomp;

    /**
     * @ORM\OneToMany(targetEntity=Detailtontine::class, mappedBy="tontine")
     */
    private $detailtontines;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $appointrest;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $solde;

    /**
     * @ORM\Column(type="string", length=16)
     */
    private $niveau;

    /**
     * @ORM\OneToMany(targetEntity=Avancement::class, mappedBy="tontine")
     */
    private $avancements;

    /**
     * @ORM\OneToOne(targetEntity=Collecte::class, mappedBy="tontine", cascade={"persist", "remove"})
     */
    private $collecte;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private $mtcollecte;

    public function __construct()
    {
        $this->setDateinscr(new \DateTime('now'));
        $this->actif=true;
        $this->feuillet=1;
        $this->numordre=0;
        $this->meconomie=0;
        $this->nbfeuillet=0;
        $this->mtcollecte=0; // Sinon la rêquête de solde va envoyer 0
        $this->avance=0; // Sinon la rêquête de solde va envoyer 0
        $this->detailtontines = new ArrayCollection();
        $this->operations = new ArrayCollection();
        $this->avancements = new ArrayCollection();
    }


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

    public function setDateinscr( $dateinscr): self
    {
        $this->dateinscr = $dateinscr;

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

    public function getMcredit(): ?int
    {
        return $this->mcredit;
    }

    public function setMcredit(?int $mcredit): self
    {
        $this->mcredit = $mcredit;

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


    public function getFinfeuillet(): ?string
    {
        return $this->finfeuillet;
    }

    public function setFinfeuillet(?string $finfeuillet): self
    {
        $this->finfeuillet = $finfeuillet;

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
        return $this ->reflivret;
    }

//    /**
//     * @return Collection|Operation[]
//     */
//    public function getOperations(): Collection
//    {
//        return $this->operations;
//    }
//
//    public function addOperation(Operation $operation): self
//    {
//        if (!$this->operations->contains($operation)) {
//            $this->operations[] = $operation;
//            $operation->setTontine($this);
//        }
//
//        return $this;
//    }
//
//    public function removeOperation(Operation $operation): self
//    {
//        if ($this->operations->removeElement($operation)) {
//            // set the owning side to null (unless already changed)
//            if ($operation->getTontine() === $this) {
//                $operation->setTontine(null);
//            }
//        }
//
//        return $this;
//    }

    public function getReflivret(): ?string
    {
        return $this->reflivret;
    }

    public function setReflivret(string $reflivret): self
    {
        $this->reflivret = $reflivret;

        return $this;
    }

    public function getMdebit(): ?int
    {
        return $this->mdebit;
    }

    public function setMdebit(?int $mdebit): self
    {
        $this->mdebit = $mdebit;

        return $this;
    }


    public function getNote(): ?string
    {
        return $this->Note;
    }

    public function setNote(?string $Note): self
    {
        $this->Note = $Note;

        return $this;
    }

    public function getActif(): ?bool
    {
        return $this->actif;
    }

    public function setActif(bool $actif): self
    {
        $this->actif = $actif;

        return $this;
    }

    public function getBloqueravance(): ?bool
    {
        return $this->bloqueravance;
    }

    public function setBloqueravance(?bool $bloqueravance): self
    {
        $this->bloqueravance = $bloqueravance;

        return $this;
    }

    public function getNbfeuillet(): ?int
    {
        return $this->nbfeuillet;
    }

    public function setNbfeuillet(int $nbfeuillet): self
    {
        $this->nbfeuillet = $nbfeuillet;

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

    public function getNumcomp(): ?string
    {
        return $this->numcomp;
    }

    public function setNumcomp(string $numcomp): self
    {
        $this->numcomp = $numcomp;

        return $this;
    }

    /**
     * @return Collection|Detailtontine[]
     */
    public function getDetailtontines(): Collection
    {
        return $this->detailtontines;
    }

    public function addDetailtontine(Detailtontine $detailtontine): self
    {
        if (!$this->detailtontines->contains($detailtontine)) {
            $this->detailtontines[] = $detailtontine;
            $detailtontine->setTontine($this);
        }

        return $this;
    }

    public function removeDetailtontine(Detailtontine $detailtontine): self
    {
        if ($this->detailtontines->removeElement($detailtontine)) {
            // set the owning side to null (unless already changed)
            if ($detailtontine->getTontine() === $this) {
                $detailtontine->setTontine(null);
            }
        }

        return $this;
    }

    public function getRanglivret(): ?int
    {
        return $this->ranglivret;
    }

    public function setRanglivret(int $ranglivret): self
    {
        $this->ranglivret = $ranglivret;

        return $this;
    }

    public function getAppointrest(): ?int
    {
        return $this->appointrest;
    }

    public function setAppointrest(?int $appointrest): self
    {
        $this->appointrest = $appointrest;

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
            $operation->setTontine($this);
        }

        return $this;
    }

    public function removeOperation(Operation $operation): self
    {
        if ($this->operations->removeElement($operation)) {
            // set the owning side to null (unless already changed)
            if ($operation->getTontine() === $this) {
                $operation->setTontine(null);
            }
        }

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

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * @return Collection|Avancement[]
     */
    public function getAvancements(): Collection
    {
        return $this->avancements;
    }

    public function addAvancement(Avancement $avancement): self
    {
        if (!$this->avancements->contains($avancement)) {
            $this->avancements[] = $avancement;
            $avancement->setTontine($this);
        }

        return $this;
    }

    public function removeAvancement(Avancement $avancement): self
    {
        if ($this->avancements->removeElement($avancement)) {
            // set the owning side to null (unless already changed)
            if ($avancement->getTontine() === $this) {
                $avancement->setTontine(null);
            }
        }

        return $this;
    }

    public function getCollecte(): ?Collecte
    {
        return $this->collecte;
    }

    public function setCollecte(Collecte $collecte): self
    {
        // set the owning side of the relation if necessary
        if ($collecte->getTontine() !== $this) {
            $collecte->setTontine($this);
        }

        $this->collecte = $collecte;

        return $this;
    }

    public function getMtcollecte(): ?int
    {
        return $this->mtcollecte;
    }

    public function setMtcollecte(?int $mtcollecte): self
    {
        $this->mtcollecte = $mtcollecte;

        return $this;
    }
}
