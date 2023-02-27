<?php

namespace App\Entity;

use App\Repository\AlimentationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlimentationRepository::class)]
class Alimentation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $kcal = null;

    #[ORM\Column]
    private ?float $eau = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToMany(targetEntity: Nutriment::class, inversedBy: 'alimentations')]
    private Collection $Nutriment;

    #[ORM\ManyToOne(inversedBy: 'alimentations')]
    private ?TypeRepas $TypeRepas = null;

    public function __construct()
    {
        $this->Nutriment = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getKcal(): ?int
    {
        return $this->kcal;
    }

    public function setKcal(int $kcal): self
    {
        $this->kcal = $kcal;

        return $this;
    }

    public function getEau(): ?float
    {
        return $this->eau;
    }

    public function setEau(float $eau): self
    {
        $this->eau = $eau;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection<int, Nutriment>
     */
    public function getNutriment(): Collection
    {
        return $this->Nutriment;
    }

    public function addNutriment(Nutriment $nutriment): self
    {
        if (!$this->Nutriment->contains($nutriment)) {
            $this->Nutriment->add($nutriment);
        }

        return $this;
    }

    public function removeNutriment(Nutriment $nutriment): self
    {
        $this->Nutriment->removeElement($nutriment);

        return $this;
    }

    public function getTypeRepas(): ?TypeRepas
    {
        return $this->TypeRepas;
    }

    public function setTypeRepas(?TypeRepas $TypeRepas): self
    {
        $this->TypeRepas = $TypeRepas;

        return $this;
    }
}
