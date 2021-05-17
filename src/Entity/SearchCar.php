<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class SearchCar
{

    /**
     * minYear
     * 
     * @Assert\LessThanOrEqual(
     *     propertyPath = "maxYear",
     *     message = "l'année doit être plus petit que l'année max"
     * )
     *
     * @var int|null
     */
    private $minYear;

    /**
     * maxYear
     * 
     * @Assert\GreaterThanOrEqual(
     *     propertyPath = "minYear",
     *     message = "l'année doit être plus grande que l'année mini"
     * )
     * 
     * @var int|null
     */
    private $maxYear;

    /**
     * immatriculation
     *
     * @var string
     */
    private $immatriculation;


    public function getMinYear(): ?int
    {
        return $this->minYear;
    }

    public function getMaxYear(): ?int
    {
        return $this->maxYear;
    }

    public function setMinYear(?int $year): self
    {
        $this->minYear = $year;
        return $this;
    }

    public function setMaxYear(?int $year): self
    {
        $this->maxYear = $year;
        return $this;
    }

    public function getImmatriculation(): ?string
    {
        return $this->immatriculation;
    }

    public function setImmatriculation(?string $immatriculation): self
    {
        $this->immatriculation = $immatriculation;
        return $this;
    }
}
