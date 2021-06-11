<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity(fields={"nom","prenoms","datenais"}, message="Ce client existe déjà")

 */
class Client
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
    private $nom;



    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenoms;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lieu;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $profession;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $activite;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $quartier;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $arrondissement;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $commune;

    /**
     * @ORM\Column(type="date")
     */
    private $datenais;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Gedmo\Slug(fields={"nom","prenoms"})
     */
    private $slug;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdOn;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $createdBy;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $editedOn;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $editedBy;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $type;

    /**
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     *
     */
    private $url;

    /**
     * @ORM\Column(name="alt", type="string", length=255,nullable=true)
     *
     */
    private $alt;

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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

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


    public function getPrenoms(): ?string
    {
        return $this->prenoms;
    }

    public function setPrenoms(string $prenoms): self
    {
        $this->prenoms = $prenoms;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getProfession(): ?string
    {
        return $this->profession;
    }

    public function setProfession(string $profession): self
    {
        $this->profession = $profession;

        return $this;
    }

    public function getActivite(): ?string
    {
        return $this->activite;
    }

    public function setActivite(string $activite): self
    {
        $this->activite = $activite;

        return $this;
    }

    public function getQuartier(): ?string
    {
        return $this->quartier;
    }

    public function setQuartier(string $quartier): self
    {
        $this->quartier = $quartier;

        return $this;
    }

    public function getArrondissement(): ?string
    {
        return $this->arrondissement;
    }

    public function setArrondissement(string $arrondissement): self
    {
        $this->arrondissement = $arrondissement;

        return $this;
    }

    public function getCommune(): ?string
    {
        return $this->commune;
    }

    public function setCommune(string $commune): self
    {
        $this->commune = $commune;

        return $this;
    }

    public function getDatenais(): ?\DateTimeInterface
    {
        return $this->datenais;
    }

    public function setDatenais(\DateTimeInterface $datenais): self
    {
        $this->datenais = $datenais;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->nom.' '.$this->prenoms;
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
        $this->alt = $this->file->getClientOriginalName();




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
            $oldFile = $this->getUploadRootDir().'/'.$this->slug.'.'.$this->tempFilename;
            if (file_exists($oldFile)) {
                unlink($oldFile);
            }

        }

        // On déplace le fichier envoyé dans le répertoire de notre choix

        $this->file->move(
            $this->getUploadRootDir(), // Le répertoire de destination
            $this->slug.'.'.$this->url   // Le nom du fichier à créer, ici « slug.extension »

        );

    }


    /**
     * @ORM\PreRemove()
     */
    public function preRemoveUpload()
    {
        // On sauvegarde temporairement le nom du fichier, car il dépend du slug
        $this->tempFilename = $this->getUploadRootDir().'/'.$this->slug.'.'.$this->url;
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
        return 'uploads/images/clients';
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

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
