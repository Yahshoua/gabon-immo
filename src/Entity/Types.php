<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Slugify\Slugify;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypesRepository")
 */
class Types
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
    private $types;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Appartement", mappedBy="types")
     */
    private $appartement;

    public function __construct()
    {
        $this->appartement = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypes(): ?string
    {
        return $this->types;
    }

    public function setTypes(string $types): self
    {
        $this->types = $types;

        return $this;
    }

    /**
     * @return Collection|Appartement[]
     */
    public function getAppartement(): Collection
    {
        return $this->appartement;
    }

    public function addAppartement(Appartement $appartement): self
    {
        if (!$this->appartement->contains($appartement)) {
            $this->appartement[] = $appartement;
        }

        return $this;
    }
    public function getPage(?string $titre):self 
    {
        return (new Slugify())->slugify($titre);
    }
    public function removeAppartement(Appartement $appartement): self
    {
        if ($this->appartement->contains($appartement)) {
            $this->appartement->removeElement($appartement);
        }

        return $this;
    }
}
