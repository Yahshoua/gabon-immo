<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Entity\File as EmbeddedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
/**
 * @ORM\Entity(repositoryClass="App\Repository\AppartementRepository")
 * @Vich\Uploadable
 */
class Appartement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $quartier;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix;


    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

 
    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $caracteristiques = [];

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $annee;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $douches;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $parking;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $garage;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $surface;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $chambres;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $etages;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $piscines;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $salons;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $balcons;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cuisines;
    /**
     * @ORM\Column(type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $updatedAt;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Photos", mappedBy="appartement")
     */
    private $photos;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category")
     * 
     */
    private $Category;

     /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="appart_image", fileNameProperty="image.name", size="image.size", mimeType="image.mimeType", originalName="image.originalName", dimensions="image.dimensions")
     *
     * @var File
     */
    private $imageFile;
     /**
     * @ORM\Embedded(class="Vich\UploaderBundle\Entity\File")
     *
     * @var EmbeddedFile
     */
    private $image;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Types", inversedBy="appartement")
     */
    private $types;
    public function __construct()
    {
        $this->photos = new ArrayCollection();
        $this->image = new EmbeddedFile();
        $this->types = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }


    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }
    public function getSlugs():string {
         return (new Slugify())->slugify($this->title);
    }
    public function getCaracteristiques(): ?array
    {
        return $this->caracteristiques;
    }

    public function setCaracteristiques(?array $caracteristiques): self
    {
        $this->caracteristiques = $caracteristiques;

        return $this;
    }

    public function getannee(): ?int
    {
        return $this->annee;
    }

    public function setannee(?int $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getDouches(): ?string
    {
        return $this->douches;
    }

    public function setDouches(?string $douches): self
    {
        $this->douches = $douches;

        return $this;
    }

    public function getParking(): ?int
    {
        return $this->parking;
    }

    public function setParking(?int $parking): self
    {
        $this->parking = $parking;

        return $this;
    }

    public function getGarage(): ?int
    {
        return $this->garage;
    }

    public function setGarage(?int $garage): self
    {
        $this->garage = $garage;

        return $this;
    }

    public function getSurface(): ?float
    {
        return $this->surface;
    }

    public function setSurface(?float $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getChambres(): ?int
    {
        return $this->chambres;
    }

    public function setChambres(?int $chambres): self
    {
        $this->chambres = $chambres;

        return $this;
    }

    public function getEtages(): ?int
    {
        return $this->etages;
    }

    public function setEtages(?int $etages): self
    {
        $this->etages = $etages;

        return $this;
    }

    public function getPiscines(): ?int
    {
        return $this->piscines;
    }

    public function setPiscines(?int $piscines): self
    {
        $this->piscines = $piscines;

        return $this;
    }

    public function getSalons(): ?int
    {
        return $this->salons;
    }

    public function setSalons(?int $salons): self
    {
        $this->salons = $salons;

        return $this;
    }

    public function getBalcons(): ?int
    {
        return $this->balcons;
    }

    public function setBalcons(?int $balcons): self
    {
        $this->balcons = $balcons;

        return $this;
    }

    public function getCuisines(): ?int
    {
        return $this->cuisines;
    }

    public function setCuisines(?int $cuisines): self
    {
        $this->cuisines = $cuisines;

        return $this;
    }
    /**
     * @return Collection|Photos[]
     */
    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(Photos $photo): self
    {
        if (!$this->photos->contains($photo)) {
            $this->photos[] = $photo;
            $photo->setAppartement($this);
        }

        return $this;
    }

    public function removePhoto(Photos $photo): self
    {
        if ($this->photos->contains($photo)) {
            $this->photos->removeElement($photo);
            // set the owning side to null (unless already changed)
            if ($photo->getAppartement() === $this) {
                $photo->setAppartement(null);
            }
        }

        return $this;
    }


    public function getCategory(): ?Category
    {
        return $this->Category;
    }

    public function setCategory(?Category $Category): self
    {
        $this->Category = $Category;

        return $this;
    }
    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|UploadedFile $imageFile
     */
    public function setImageFile(?File $imageFile = null)
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImage(EmbeddedFile $image)
    {
        $this->image = $image;
    }

    public function getImage(): ?EmbeddedFile
    {
        return $this->image;
    }

    /**
     * @return Collection|Types[]
     */
    public function getTypes(): Collection
    {
        return $this->types;
    }

    public function addType(Types $type): self
    {
        if (!$this->types->contains($type)) {
            $this->types[] = $type;
            $type->addAppartement($this);
        }

        return $this;
    }

    public function removeType(Types $type): self
    {
        if ($this->types->contains($type)) {
            $this->types->removeElement($type);
            $type->removeAppartement($this);
        }

        return $this;
    }
}
