<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\MealFoodRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MealFoodRepository::class)]
#[ApiResource]

#[ORM\Entity(repositoryClass: MealFoodRepository::class)]
class MealFood
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity="Meal")]
    private $meal;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity="Food")]
    private $food;


    #[ORM\Column(type="integer")]
    private $quantity;

    // getters and setters
}