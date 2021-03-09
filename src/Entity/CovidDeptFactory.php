<?php

namespace App\Entity;

use App\Repository\CovidDeptFactoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CovidDeptFactoryRepository::class)
 */
class CovidDeptFactory
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=CovidDept::class, mappedBy="covidDeptFactory")
     */
    private $listeDept;

    public function __construct()
    {
        $this->listeDept = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|CovidDept[]
     */
    public function getListeDept(): Collection
    {
        return $this->listeDept;
    }

    public function addListeDept(CovidDept $listeDept): self
    {
        if (!$this->listeDept->contains($listeDept)) {
            $this->listeDept[] = $listeDept;
            $listeDept->setCovidDeptFactory($this);
        }

        return $this;
    }

    public function removeListeDept(CovidDept $listeDept): self
    {
        if ($this->listeDept->removeElement($listeDept)) {
            // set the owning side to null (unless already changed)
            if ($listeDept->getCovidDeptFactory() === $this) {
                $listeDept->setCovidDeptFactory(null);
            }
        }

        return $this;
    }
}
