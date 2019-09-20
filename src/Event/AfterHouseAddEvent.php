<?php


namespace App\Event;

use App\Entity\House;
use Symfony\Component\EventDispatcher\Event;

class AfterHouseAddEvent extends Event
{
    public const NAME = 'house.add';

    /**
     * @var House
     */
    private $addedHouse;

    /**
     * AfterHouseAddEvent constructor.
     * @param House $addedHouse
     */
    public function __construct(House $addedHouse)
    {
        $this->addedHouse = $addedHouse;
    }

    /**
     * @return House
     */
    public function getAddedHouse(): House
    {
        return $this->addedHouse;
    }

}