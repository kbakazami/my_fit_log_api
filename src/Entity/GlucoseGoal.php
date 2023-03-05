<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\GlucoseGoalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GlucoseGoalRepository::class)]
#[ApiResource]
class GlucoseGoal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $glucoseMin = null;

    #[ORM\Column]
    private ?float $glucoseMax = null;

    #[ORM\Column]
    private ?float $glucoseMinF = null;

    #[ORM\Column]
    private ?float $glucoseMaxF = null;

    #[ORM\OneToMany(mappedBy: 'glucoseGoal', targetEntity: User::class)]
    private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGlucoseMin(): ?float
    {
        return $this->glucoseMin;
    }

    public function setGlucoseMin(float $glucoseMin): self
    {
        $this->glucoseMin = $glucoseMin;

        return $this;
    }

    public function getGlucoseMax(): ?float
    {
        return $this->glucoseMax;
    }

    public function setGlucoseMax(float $glucoseMax): self
    {
        $this->glucoseMax = $glucoseMax;

        return $this;
    }

    public function getGlucoseMinF(): ?float
    {
        return $this->glucoseMinF;
    }

    public function setGlucoseMinF(float $glucoseMinF): self
    {
        $this->glucoseMinF = $glucoseMinF;

        return $this;
    }

    public function getGlucoseMaxF(): ?float
    {
        return $this->glucoseMaxF;
    }

    public function setGlucoseMaxF(float $glucoseMaxF): self
    {
        $this->glucoseMaxF = $glucoseMaxF;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setGlucoseGoal($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getGlucoseGoal() === $this) {
                $user->setGlucoseGoal(null);
            }
        }

        return $this;
    }
}
