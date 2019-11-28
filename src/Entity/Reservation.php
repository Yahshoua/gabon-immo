<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReservationRepository")
 */
class Reservation
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
    private $fullname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="integer")
     */
    private $numero;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dates;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dates2;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Appartement", inversedBy="reservations")
     */
    private $Appartement;

    public function __construct()
    {
        $this->Appartement = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullname(): ?string
    {
        return $this->fullname;
    }

    public function setFullname(string $fullname): self
    {
        $this->fullname = $fullname;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getDates(): ?string
    {
        return $this->dates;
    }

    public function setDates(string $dates): self
    {
        $this->dates = $dates;

        return $this;
    }

    public function getDates2(): ?string
    {
        return $this->dates2;
    }

    public function setDates2(string $dates2): self
    {
        $this->dates2 = $dates2;

        return $this;
    }

    /**
     * @return Collection|Appartement[]
     */
    public function getAppartement(): Collection
    {
        return $this->Appartement;
    }

    public function addAppartement(Appartement $appartement): self
    {
        if (!$this->Appartement->contains($appartement)) {
            $this->Appartement[] = $appartement;
        }

        return $this;
    }

    public function removeAppartement(Appartement $appartement): self
    {
        if ($this->Appartement->contains($appartement)) {
            $this->Appartement->removeElement($appartement);
        }

        return $this;
    }
}
