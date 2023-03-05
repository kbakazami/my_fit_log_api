<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\MealGoalDayRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MealGoalDayRepository::class)]
#[ApiResource]
class MealGoalDay
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $waterIntake = null;

    #[ORM\Column]
    private ?float $water = null;

    #[ORM\Column]
    private ?int $numberMeals = null;

    #[ORM\Column]
    private ?int $calorie = null;

    #[ORM\OneToMany(mappedBy: 'mealGoalDay', targetEntity: User::class)]
    private Collection $user;

    public function __construct()
    {
        $this->user = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getWater(): ?float
    {
        return $this->water;
    }

    public function setWater(float $water): self
    {
        $this->water = $water;

        return $this;
    }

    public function getNumberMeals(): ?int
    {
        return $this->numberMeals;
    }

    public function setNumberMeals(int $numberMeals): self
    {
        $this->numberMeals = $numberMeals;

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

    /**
     * @return Collection<int, User>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user->add($user);
            $user->setMealGoalDay($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->user->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getMealGoalDay() === $this) {
                $user->setMealGoalDay(null);
            }
        }

        return $this;
    }
}
