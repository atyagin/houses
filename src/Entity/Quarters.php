<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuartersRepository")
 */
class Quarters
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", options={"unsigned"=true})
     */
    private $number;

    /**
     * @ORM\Column(type="integer")
     */
    private $floor;

    /**
     * @ORM\Column(type="integer", options={"unsigned"=true})
     */
    private $rooms;

    /**
     * @ORM\Column(type="float")
     */
    private $square;

    /**
     * @ORM\Column(type="integer", options={"unsigned"=true})
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\House", inversedBy="quarters")
     * @ORM\JoinColumn(nullable=false)
     */
    private $house;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\QuartersType")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Type;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getFloor(): ?int
    {
        return $this->floor;
    }

    public function setFloor(int $floor): self
    {
        $this->floor = $floor;

        return $this;
    }

    public function getRooms(): ?int
    {
        return $this->rooms;
    }

    public function setRooms(int $rooms): self
    {
        $this->rooms = $rooms;

        return $this;
    }

    public function getSquare(): ?float
    {
        return $this->square;
    }

    public function setSquare(float $square): self
    {
        $this->square = $square;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getHouse(): ?House
    {
        return $this->house;
    }

    public function setHouse(?House $house): self
    {
        $this->house = $house;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getType(): ?QuartersType
    {
        return $this->Type;
    }

    public function setType(?QuartersType $Type): self
    {
        $this->Type = $Type;

        return $this;
    }
}
