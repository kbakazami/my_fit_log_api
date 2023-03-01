<?php

namespace App\Entity;

use ApiPlatform\Action\NotFoundAction;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Controller\MeController;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Lexik\Bundle\JWTAuthenticationBundle\Security\User\JWTUserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ApiResource(
    operations: [
        new Get(
            controller: NotFoundAction::class,
            output: false,
            read: false,
        ),
        new Get(
            uriTemplate: '/me',
            controller: MeController::class,
            paginationEnabled: false,
            read: false,
            name: 'me',
        ),
    ],
    normalizationContext: [
        'groups' => ['read:User'],
    ],
    openapiContext: [
        'security' => [
            [
                'bearerAuth' => [],
            ],
        ],
    ],
)]
class User implements UserInterface, PasswordAuthenticatedUserInterface, JWTUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Water::class)]
    private Collection $waters;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $birthdate = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $accesAt = null;

    #[ORM\Column]
    private ?bool $isActive = null;

    #[ORM\ManyToOne(inversedBy: 'user')]
    private ?MealGoalDay $mealGoalDay = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?GlucoseGoal $glucoseGoal = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Meal::class)]
    private Collection $meals;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Glucose::class)]
    private Collection $glucoses;

    public function __construct()
    {
        $this->waters = new ArrayCollection();
        $this->meals = new ArrayCollection();
        $this->glucoses = new ArrayCollection();
    }

    #[Groups(['read:User'])]
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    #[Groups(['read:User'])]
    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    #[Groups(['read:User'])]
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public static function createFromPayload($id, array $payload)
    {
        return (new self())->setId($id)->setEmail($payload['email'] ?? '');
    }

    /**
     * @return Collection<int, Water>
     */
    public function getWaters(): Collection
    {
        return $this->waters;
    }

    public function addWater(Water $water): self
    {
        if (!$this->waters->contains($water)) {
            $this->waters->add($water);
            $water->setUser($this);
        }

        return $this;
    }

    public function removeWater(Water $water): self
    {
        if ($this->waters->removeElement($water)) {
            // set the owning side to null (unless already changed)
            if ($water->getUser() === $this) {
                $water->setUser(null);
            }
        }

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
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

    public function getAccesAt(): ?\DateTimeInterface
    {
        return $this->accesAt;
    }

    public function setAccesAt(\DateTimeInterface $accesAt): self
    {
        $this->accesAt = $accesAt;

        return $this;
    }

    public function isIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getMealGoalDay(): ?MealGoalDay
    {
        return $this->mealGoalDay;
    }

    public function setMealGoalDay(?MealGoalDay $mealGoalDay): self
    {
        $this->mealGoalDay = $mealGoalDay;

        return $this;
    }

    public function getGlucoseGoal(): ?GlucoseGoal
    {
        return $this->glucoseGoal;
    }

    public function setGlucoseGoal(?GlucoseGoal $glucoseGoal): self
    {
        $this->glucoseGoal = $glucoseGoal;

        return $this;
    }

    /**
     * @return Collection<int, Meal>
     */
    public function getMeals(): Collection
    {
        return $this->meals;
    }

    public function addMeal(Meal $meal): self
    {
        if (!$this->meals->contains($meal)) {
            $this->meals->add($meal);
            $meal->setUser($this);
        }

        return $this;
    }

    public function removeMeal(Meal $meal): self
    {
        if ($this->meals->removeElement($meal)) {
            // set the owning side to null (unless already changed)
            if ($meal->getUser() === $this) {
                $meal->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Glucose>
     */
    public function getGlucoses(): Collection
    {
        return $this->glucoses;
    }

    public function addGlucose(Glucose $glucose): self
    {
        if (!$this->glucoses->contains($glucose)) {
            $this->glucoses->add($glucose);
            $glucose->setUser($this);
        }

        return $this;
    }

    public function removeGlucose(Glucose $glucose): self
    {
        if ($this->glucoses->removeElement($glucose)) {
            // set the owning side to null (unless already changed)
            if ($glucose->getUser() === $this) {
                $glucose->setUser(null);
            }
        }

        return $this;
    }
}
