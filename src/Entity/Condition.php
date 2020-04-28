<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ConditionRepository")
 * @ORM\Table(name="conditions")
 */
class Condition
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $temperature;

    /**
     * @ORM\Column(type="integer")
     */
    private $pressure;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $rawMetar;

    /**
     * @ORM\Column(type="integer")
     */
    private $visibility;

    /**
     * @var Weather
     * @ORM\ManyToOne(targetEntity="App\Entity\Weather", inversedBy="conditions")
     */
    private $weather;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTemperature(): ?int
    {
        return $this->temperature;
    }

    public function setTemperature(int $temperature): self
    {
        $this->temperature = $temperature;

        return $this;
    }

    public function getPressure(): ?int
    {
        return $this->pressure;
    }

    public function setPressure(int $pressure): self
    {
        $this->pressure = $pressure;

        return $this;
    }

    public function getVisibility(): ?int
    {
        return $this->visibility;
    }

    public function setVisibility(int $visibility): self
    {
        $this->visibility = $visibility;

        return $this;
    }

    /**
     * @return Weather
     */
    public function getWeather(): Weather
    {
        return $this->weather;
    }

    /**
     * @param Weather $weather
     * @return Condition
     */
    public function setWeather(Weather $weather): self
    {
        $this->weather = $weather;
        return $this;
    }

    /**
     * @return string
     */
    public function getRawMetar(): string
    {
        return $this->rawMetar;
    }

    /**
     * @param string $rawMetar
     * @return Condition
     */
    public function setRawMetar(string $rawMetar): self
    {
        $this->rawMetar = $rawMetar;
        return $this;
    }
}
