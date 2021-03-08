<?php

namespace App\Entity;

use App\Repository\FilmRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FilmRepository::class)
 */
class Film
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
    private $titre;

    /**
     * @ORM\Column(type="integer")
     */
    private $annee;

    /**
     * @ORM\Column(type="integer")
     */
    private $coutFilm;

    /**
     * @ORM\ManyToMany(targetEntity=Acteur::class, inversedBy="films")
     */
    private $acteurs;

    public function __construct()
    {
        $this->acteurs = new ArrayCollection();
        
    }

    public function __toString()
    {
        return $this->getTitre();
    }

    public function setCoutFilmActeurs()
    {
        $coutFilm = 0;

        foreach ($this->getActeurs() as $acteur) {
            $coutFilm += $acteur->getSalaire();
        }
        $this->setCoutFilm($coutFilm);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getAnnee(): ?int
    {
        return $this->annee;
    }

    public function setAnnee(int $annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getCoutFilm(): ?int
    {
        return $this->coutFilm;
    }

    public function setCoutFilm(int $coutFilm): self
    {
        $this->coutFilm = $coutFilm;

        return $this;
    }

    /**
     * @return Collection|Acteur[]
     */
    public function getActeurs(): Collection
    {
        return $this->acteurs;
    }

    public function addActeur(Acteur $acteur): self
    {
        if (!$this->acteurs->contains($acteur)) {
            $this->acteurs[] = $acteur;
        }

        return $this;
    }

    public function removeActeur(Acteur $acteur): self
    {
        $this->acteurs->removeElement($acteur);

        return $this;
    }
}
