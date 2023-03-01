<?php

namespace App\Entity;

use App\Repository\FoodRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FoodRepository::class)]
class Food
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $defaultGrams = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $calorie = null;

    #[ORM\Column]
    private ?float $waterIntake = null;

    #[ORM\Column]
    private ?float $fiber = null;

    #[ORM\Column]
    private ?float $protein = null;

    #[ORM\Column]
    private ?float $carbohydrate = null;

    #[ORM\Column]
    private ?float $lipid = null;

    #[ORM\OneToMany(mappedBy: 'food', targetEntity: MealFood::class)]
    private Collection $mealFood;

    public function __construct()
    {
        $this->mealFood = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDefaultGrams(): ?int
    {
        return $this->defaultGrams;
    }

    public function setDefaultGrams(int $defaultGrams): self
    {
        $this->defaultGrams = $defaultGrams;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCalorie(): ?int
    {
        return $this->calorie;
    }

    public function setCalorie(int $calorie): self
    {
        $this->calorie = $calorie;

        return $this;
    }

    public function getWaterIntake(): ?float
    {
        return $this->waterIntake;
    }

    public function setWaterIntake(float $waterIntake): self
    {
        $this->waterIntake = $waterIntake;

        return $this;
    }

    public function getFiber(): ?float
    {
        return $this->fiber;
    }

    public function setFiber(float $fiber): self
    {
        $this->fiber = $fiber;

        return $this;
    }

    public function getProtein(): ?float
    {
        return $this->protein;
    }

    public function setProtein(float $protein): self
    {
        $this->protein = $protein;

        return $this;
    }

    public function getCarbohydrate(): ?float
    {
        return $this->carbohydrate;
    }

    public function setCarbohydrate(float $carbohydrate): self
    {
        $this->carbohydrate = $carbohydrate;

        return $this;
    }

    public function getLipid(): ?float
    {
        return $this->lipid;
    }

    public function setLipid(float $lipid): self
    {
        $this->lipid = $lipid;

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
            $mealFood->setFood($this);
        }

        return $this;
    }

    public function removeMealFood(MealFood $mealFood): self
    {
        if ($this->mealFood->removeElement($mealFood)) {
            // set the owning side to null (unless already changed)
            if ($mealFood->getFood() === $this) {
                $mealFood->setFood(null);
            }
        }

        return $this;
    }
}
