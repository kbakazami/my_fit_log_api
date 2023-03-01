<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\MealRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MealRepository::class)]
#[ApiResource]
class Meal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $note = null;

    #[ORM\ManyToOne(inversedBy: 'meals')]
    private ?MealType $mealType = null;

    #[ORM\ManyToOne(inversedBy: 'meals')]
    private ?User $user = null;

    #[ORM\OneToMany(mappedBy: 'meal', targetEntity: MealFood::class)]
    private Collection $mealFood;

    public function __construct()
    {
        $this->mealFood = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
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

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(string $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getMealType(): ?MealType
    {
        return $this->mealType;
    }

    public function setMealType(?MealType $mealType): self
    {
        $this->mealType = $mealType;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, MealFood>
     */
    public function getMealFood(): Collection
    {
        return $this->mealFood;
    }

    public function addMealFood(MealFood $mealFood): self
    {
        if (!$this->mealFood->contains($mealFood)) {
            $this->mealFood->add($mealFood);
            $mealFood->setMeal($this);
        }

        return $this;
    }

    public function removeMealFood(MealFood $mealFood): self
    {
        if ($this->mealFood->removeElement($mealFood)) {
            // set the owning side to null (unless already changed)
            if ($mealFood->getMeal() === $this) {
                $mealFood->setMeal(null);
            }
        }

        return $this;
    }

}
