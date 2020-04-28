<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="winds")
 * @ORM\Entity(repositoryClass="App\Repository\WindRepository")
 */
class Wind
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
    private $heading;

    /**
     * @ORM\Column(type="integer")
     */
    private $speed;

    /**
     * @ORM\Column(type="integer")
     */
    private $gusts;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", name="created_at")
     */
    private $createdAt;

    /**
     * @var Weather
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Weather", inversedBy="winds")
     */
    private $weather;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHeading(): ?int
    {
        return $this->heading;
    }

    public function setHeading(int $heading): self
    {
        $this->heading = $heading;

        return $this;
    }

    public function getSpeed(): ?int
    {
        return $this->speed;
    }

    public function setSpeed(int $speed): self
    {
        $this->speed = $speed;

        return $this;
    }

    public function getGusts(): ?int
    {
        return $this->gusts;
    }

    public function setGusts(int $gusts): self
    {
        $this->gusts = $gusts;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;
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
     * @return Wind
     */
    public function setWeather(Weather $weather): self
    {
        $this->weather = $weather;
        return $this;
    }
}
