<?php

namespace App\Entity;

use App\Repository\ObjectifGlucoseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ObjectifGlucoseRepository::class)]
class ObjectifGlucose
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $glycemiemin = null;

    #[ORM\Column]
    private ?float $glycemiemax = null;

    #[ORM\Column]
    private ?float $glycemiemaxa = null;

    #[ORM\Column]
    private ?float $glycemiemina = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGlycemiemin(): ?float
    {
        return $this->glycemiemin;
    }

    public function setGlycemiemin(float $glycemiemin): self
    {
        $this->glycemiemin = $glycemiemin;

        return $this;
    }

    public function getGlycemiemax(): ?float
    {
        return $this->glycemiemax;
    }

    public function setGlycemiemax(float $glycemiemax): self
    {
        $this->glycemiemax = $glycemiemax;

        return $this;
    }

    public function getGlycemiemaxa(): ?float
    {
        return $this->glycemiemaxa;
    }

    public function setGlycemiemaxa(float $glycemiemaxa): self
    {
        $this->glycemiemaxa = $glycemiemaxa;

        return $this;
    }

    public function getGlycemiemina(): ?float
    {
        return $this->glycemiemina;
    }

    public function setGlycemiemina(float $glycemiemina): self
    {
        $this->glycemiemina = $glycemiemina;

        return $this;
    }
}
