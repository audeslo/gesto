<?php

namespace App\Entity;

use App\Repository\AgentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AgentRepository::class)
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(fields={"nomag","prenomag","datenaiss"}, message="Cet agent existe déjà")
 */
class Agent
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nomag;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prenomag;

    /**
     * @ORM\Column(type="string", length=2, nullable=true)
     */
    private $sexe;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datenaiss;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $lieunaiss;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $telag;

    /**
     * @ORM\Column(type="string", length=70, nullable=true)
     */
    private $bpag;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateembaucheag;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adressevilleag;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresserueag;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $situationmatri;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbreenft;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $alt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nomcompletag;

    /**
     * @ORM\Column(type="bigint", nullable=true)
     */
    private $actif;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numerocompte;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Gedmo\Slug(fields={"nomag","prenomag"})
     */
    private $slug;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $editedOn;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdOn;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="agents")
     */
    private $editedBy;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="agents")
     * @ORM\JoinColumn(nullable=false)
     */
    private $createdBy;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $refag;

    /**
     * @var file
     * @Assert\Image(maxSize = "3M",
     *     mimeTypesMessage = "Uploadez un fichier JPG ou PNG", maxSizeMessage="Le fichier est trop gros (3Mo)")
     */
    private $file;


    /**
     * @var
     */
    private $tempFilename;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="agent")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity=Detailcaisse::class, mappedBy="agent")
     */
    private $detailcaisses;

    /**
     * @ORM\OneToMany(targetEntity=Pret::class, mappedBy="agent")
     */
    private $prets;

    /**
     * @ORM\PrePersist()
     */
    public function datecreated()
    {
        $this->setCreatedOn(new \DateTime('now'));
        $this->setNomcompletag($this->prenomag.' '.$this->nomag);
    }

    /**
     * @ORM\PreUpdate()
     */
    public function dateupdated()
    {
        $this->setEditedOn(new \DateTime('now'));
        $this->setNomcompletag($this->prenomag.' '.$this->nomag);
    }

    public function __construct()
    {
        $this->setDatenaiss(new \DateTime('now'));
        $this->users = new ArrayCollection();
        $this->detailcaisses = new ArrayCollection();
        $this->prets = new ArrayCollection();

    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomag(): ?string
    {
        return $this->nomag;
    }

    public function setNomag(?string $nomag): self
    {
        $this->nomag = $nomag;

        return $this;
    }

    public function getPrenomag(): ?string
    {
        return $this->prenomag;
    }

    public function setPrenomag(?string $prenomag): self
    {
        $this->prenomag = $prenomag;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(?string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getDatenaiss(): ?\DateTimeInterface
    {
        return $this->datenaiss;
    }

    public function setDatenaiss(?\DateTimeInterface $datenaiss): self
    {
        $this->datenaiss = $datenaiss;

        return $this;
    }

    public function getLieunaiss(): ?string
    {
        return $this->lieunaiss;
    }

    public function setLieunaiss(?string $lieunaiss): self
    {
        $this->lieunaiss = $lieunaiss;

        return $this;
    }

    public function getTelag(): ?string
    {
        return $this->telag;
    }

    public function setTelag(?string $telag): self
    {
        $this->telag = $telag;

        return $this;
    }

    public function getBpag(): ?string
    {
        return $this->bpag;
    }

    public function setBpag(?string $bpag): self
    {
        $this->bpag = $bpag;

        return $this;
    }

    public function getDateembaucheag(): ?\DateTimeInterface
    {
        return $this->dateembaucheag;
    }

    public function setDateembaucheag(?\DateTimeInterface $dateembaucheag): self
    {
        $this->dateembaucheag = $dateembaucheag;

        return $this;
    }

    public function getAdressevilleag(): ?string
    {
        return $this->adressevilleag;
    }

    public function setAdressevilleag(?string $adressevilleag): self
    {
        $this->adressevilleag = $adressevilleag;

        return $this;
    }

    public function getAdresserueag(): ?string
    {
        return $this->adresserueag;
    }

    public function setAdresserueag(?string $adresserueag): self
    {
        $this->adresserueag = $adresserueag;

        return $this;
    }

    public function getSituationmatri(): ?string
    {
        return $this->situationmatri;
    }

    public function setSituationmatri(?string $situationmatri): self
    {
        $this->situationmatri = $situationmatri;

        return $this;
    }

    public function getNbreenft(): ?int
    {
        return $this->nbreenft;
    }

    public function setNbreenft(?int $nbreenft): self
    {
        $this->nbreenft = $nbreenft;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getAlt(): ?string
    {
        return $this->alt;
    }

    public function setAlt(?string $alt): self
    {
        $this->alt = $alt;

        return $this;
    }

    public function getNomcompletag(): ?string
    {
        return $this->nomcompletag;
    }

    public function setNomcompletag(?string $nomcompletag): self
    {
        $this->nomcompletag = $nomcompletag;

        return $this;
    }

    public function getActif(): ?string
    {
        return $this->actif;
    }

    public function setActif(?string $actif): self
    {
        $this->actif = $actif;

        return $this;
    }

    public function getNumerocompte(): ?string
    {
        return $this->numerocompte;
    }

    public function setNumerocompte(?string $numerocompte): self
    {
        $this->numerocompte = $numerocompte;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function getFile()
    {
        return $this->file;
    }

    // On modifie le setter de File, pour prendre en compte l'upload d'un fichier lorsqu'il en existe déjà un autre
    public function setFile(UploadedFile $file)
    {
        $this->file = $file;

        // On vérifie si on avait déjà un fichier pour cet utilisateur
        if (null !== $this->url) {
            // On sauvegarde l'extension du fichier pour le supprimer plus tard
            $this->tempFilename = $this->url;

            // On réinitialise les valeurs des attributs url et alt
            $this->url = null;
            $this->alt = null;

        }

    }


    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        // Si jamais il n'y a pas de fichier (champ facultatif), on ne fait rien
        if (null === $this->file) {
            return;
        }


        // Le nom du fichier est son slug, on doit juste stocker également son extension
        // Pour faire propre, on devrait renommer cet attribut en « extension », plutôt que « url »
        $this->url = $this->file->guessExtension();

        // Et on génère l'attribut alt de la balise <img>, à la valeur du nom du fichier sur le PC de l'utilisateur
        $this->alt = $this->file->getAgentOriginalName();




    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        // Si jamais il n'y a pas de fichier (champ facultatif), on ne fait rien
        if (null === $this->file) {
            return;
        }

        // Si on avait un ancien fichier, on le supprime
        if (null !== $this->tempFilename) {
            $oldFile = $this->getUploadRootDir().'/'.$this->id.'.'.$this->tempFilename;
            if (file_exists($oldFile)) {
                unlink($oldFile);
            }

        }

        // On déplace le fichier envoyé dans le répertoire de notre choix

        $this->file->move(
            $this->getUploadRootDir(), // Le répertoire de destination
            $this->id.'.'.$this->url   // Le nom du fichier à créer, ici « slug.extension »

        );

    }


    /**
     * @ORM\PreRemove()
     */
    public function preRemoveUpload()
    {
        // On sauvegarde temporairement le nom du fichier, car il dépend du slug
        $this->tempFilename = $this->getUploadRootDir().'/'.$this->id.'.'.$this->url;
    }


    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        // En PostRemove, on n'a pas accès au slug, on utilise notre nom sauvegardé
        if (file_exists($this->tempFilename)) {
            // On supprime le fichier
            unlink($this->tempFilename);
        }
    }

    public function getUploadDir()
    {
        // On retourne le chemin relatif vers l'image pour un navigateur
        return 'uploads/images/agents';
    }

    protected function getUploadRootDir()
    {
        // On retourne le chemin relatif vers l'image pour notre code PHP
        //return __DIR__.'/../../../../web/'.$this->getUploadDir();
        return __DIR__.'/../../public/'.$this->getUploadDir();
    }

    /**
     * @return string
     */
    public function getWebPath()
    {
        return $this->getUploadDir().'/'.$this->getSlug().'.'.$this->getUrl();
    }


    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

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

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getRefag(): ?string
    {
        return $this->refag;
    }

    public function setRefag(?string $refag): self
    {
        $this->refag = $refag;

        return $this;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->nomag.' '.$this->prenomag;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setAgent($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getAgent() === $this) {
                $user->setAgent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Detailcaisse[]
     */
    public function getDetailcaisses(): Collection
    {
        return $this->detailcaisses;
    }

    public function addDetailcaiss(Detailcaisse $detailcaiss): self
    {
        if (!$this->detailcaisses->contains($detailcaiss)) {
            $this->detailcaisses[] = $detailcaiss;
            $detailcaiss->setAgent($this);
        }

        return $this;
    }

    public function removeDetailcaiss(Detailcaisse $detailcaiss): self
    {
        if ($this->detailcaisses->removeElement($detailcaiss)) {
            // set the owning side to null (unless already changed)
            if ($detailcaiss->getAgent() === $this) {
                $detailcaiss->setAgent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Pret[]
     */
    public function getPrets(): Collection
    {
        return $this->prets;
    }

    public function addPret(Pret $pret): self
    {
        if (!$this->prets->contains($pret)) {
            $this->prets[] = $pret;
            $pret->setAgent($this);
        }

        return $this;
    }

    public function removePret(Pret $pret): self
    {
        if ($this->prets->removeElement($pret)) {
            // set the owning side to null (unless already changed)
            if ($pret->getAgent() === $this) {
                $pret->setAgent(null);
            }
        }

        return $this;
    }
}
