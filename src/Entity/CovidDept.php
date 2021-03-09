<?php

namespace App\Entity;

use App\Repository\CovidDeptRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CovidDeptRepository::class)
 */
class CovidDept
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
    private $reanimation;

    /**
     * @ORM\Column(type="integer")
     */
    private $hospitalisation;

    /**
     * @ORM\ManyToOne(targetEntity=CovidDeptFactory::class, inversedBy="listeDept")
     */
    private $covidDeptFactory;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    public function __construct($nom, $rea, $hosp)
    {
        $this->nom = $nom;
        $this->reanimation = $rea;
        $this->hospitalisation = $hosp;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReanimation(): ?int
    {
        return $this->reanimation;
    }

    public function setReanimation(int $reanimation): self
    {
        $this->reanimation = $reanimation;

        return $this;
    }

    public function getHospitalisation(): ?int
    {
        return $this->hospitalisation;
    }

    public function setHospitalisation(int $hospitalisation): self
    {
        $this->hospitalisation = $hospitalisation;

        return $this;
    }

    public function getCovidDeptFactory(): ?CovidDeptFactory
    {
        return $this->covidDeptFactory;
    }

    public function setCovidDeptFactory(?CovidDeptFactory $covidDeptFactory): self
    {
        $this->covidDeptFactory = $covidDeptFactory;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }
}
