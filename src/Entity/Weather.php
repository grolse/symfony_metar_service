<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="weather")
 * @ORM\Entity(repositoryClass="App\Repository\WeatherRepository")
 */
class Weather
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=4, unique=true)
     */
    private $icaoCode;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Wind", mappedBy="weather", cascade={"persist"})
     */
    private $winds;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Condition", mappedBy="airport", cascade={"persist"})
     */
    private $conditions;

    public function __construct()
    {
        $this->winds = new ArrayCollection();
        $this->conditions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIcaoCode(): ?string
    {
        return $this->icaoCode;
    }

    public function setIcaoCode(string $icaoCode): self
    {
        $this->icaoCode = $icaoCode;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getWinds(): ArrayCollection
    {
        return $this->winds;
    }

    /**
     * @param Wind $winds
     * @return Weather
     */
    public function setWinds(Wind $winds): self
    {
        $this->winds = $winds;
        return $this;
    }

    public function addWind(Wind $wind): self
    {
        $this->winds->add($wind);
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getConditions(): ArrayCollection
    {
        return $this->conditions;
    }

    /**
     * @param ArrayCollection $conditions
     * @return Weather
     */
    public function setConditions(ArrayCollection $conditions): self
    {
        $this->conditions = $conditions;
        return $this;
    }

    public function addCondition(Condition $condition): self
    {
        $this->conditions->add($condition);
        return $this;
    }
}
