<?php

namespace App\Entity;

use App\Repository\ObjectifAlimentationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ObjectifAlimentationRepository::class)]
class ObjectifAlimentation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $kcaltotal = null;

    #[ORM\Column]
    private ?float $apporteau = null;

    #[ORM\Column]
    private ?int $nbrepas = null;

    #[ORM\ManyToMany(targetEntity: Nutriment::class, inversedBy: 'objectifAlimentations')]
    private Collection $ObjectifNutriment;

    public function __construct()
    {
        $this->ObjectifNutriment = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKcaltotal(): ?int
    {
        return $this->kcaltotal;
    }

    public function setKcaltotal(int $kcaltotal): self
    {
        $this->kcaltotal = $kcaltotal;

        return $this;
    }

    public function getApporteau(): ?float
    {
        return $this->apporteau;
    }

    public function setApporteau(float $apporteau): self
    {
        $this->apporteau = $apporteau;

        return $this;
    }

    public function getNbrepas(): ?int
    {
        return $this->nbrepas;
    }

    public function setNbrepas(int $nbrepas): self
    {
        $this->nbrepas = $nbrepas;

        return $this;
    }

    /**
     * @return Collection<int, Nutriment>
     */
    public function getObjectifNutriment(): Collection
    {
        return $this->ObjectifNutriment;
    }

    public function addObjectifNutriment(Nutriment $objectifNutriment): self
    {
        if (!$this->ObjectifNutriment->contains($objectifNutriment)) {
            $this->ObjectifNutriment->add($objectifNutriment);
        }

        return $this;
    }

    public function removeObjectifNutriment(Nutriment $objectifNutriment): self
    {
        $this->ObjectifNutriment->removeElement($objectifNutriment);

        return $this;
    }
}
