<?php

namespace App\Entity;

use App\Repository\NutrimentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;

#[ApiResource]
#[ORM\Entity(repositoryClass: NutrimentRepository::class)]
class Nutriment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nom = null;

    #[ORM\Column]
    private ?float $grammage = null;

    #[ORM\ManyToMany(targetEntity: Alimentation::class, mappedBy: 'Nutriment')]
    private Collection $alimentations;

    #[ORM\ManyToMany(targetEntity: ObjectifAlimentation::class, mappedBy: 'ObjectifNutriment')]
    private Collection $objectifAlimentations;

    public function __construct()
    {
        $this->alimentations = new ArrayCollection();
        $this->objectifAlimentations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getGrammage(): ?float
    {
        return $this->grammage;
    }

    public function setGrammage(float $grammage): self
    {
        $this->grammage = $grammage;

        return $this;
    }

    /**
     * @return Collection<int, Alimentation>
     */
    public function getAlimentations(): Collection
    {
        return $this->alimentations;
    }

    public function addAlimentation(Alimentation $alimentation): self
    {
        if (!$this->alimentations->contains($alimentation)) {
            $this->alimentations->add($alimentation);
            $alimentation->addNutriment($this);
        }

        return $this;
    }

    public function removeAlimentation(Alimentation $alimentation): self
    {
        if ($this->alimentations->removeElement($alimentation)) {
            $alimentation->removeNutriment($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, ObjectifAlimentation>
     */
    public function getObjectifAlimentations(): Collection
    {
        return $this->objectifAlimentations;
    }

    public function addObjectifAlimentation(ObjectifAlimentation $objectifAlimentation): self
    {
        if (!$this->objectifAlimentations->contains($objectifAlimentation)) {
            $this->objectifAlimentations->add($objectifAlimentation);
            $objectifAlimentation->addObjectifNutriment($this);
        }

        return $this;
    }

    public function removeObjectifAlimentation(ObjectifAlimentation $objectifAlimentation): self
    {
        if ($this->objectifAlimentations->removeElement($objectifAlimentation)) {
            $objectifAlimentation->removeObjectifNutriment($this);
        }

        return $this;
    }
}
