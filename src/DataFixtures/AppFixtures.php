<?php

namespace App\DataFixtures;

use App\Entity\House;
use App\Entity\Quarters;
use App\Entity\QuartersType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    private $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager)
    {
        $this->loadQuartersTypes($manager);
        $this->loadHouses($manager);
        $this->loadQuarters($manager);
    }

    public function loadQuartersTypes(ObjectManager $manager)
    {

        $flatType = new QuartersType();
        $flatType->setName('Квартира');
        $manager->persist($flatType);
        $this->addReference('flatType', $flatType);

        $officeType = new QuartersType();
        $officeType->setName('Офис');
        $manager->persist($officeType);
        $this->addReference('officeType', $officeType);

        $parkingType = new QuartersType();
        $parkingType->setName('Парковка');
        $manager->persist($parkingType);
        $this->addReference('parkingType', $parkingType);

        $manager->flush();

    }

    public function loadHouses(ObjectManager $manager)
    {
        for ($n = 1; $n <= 11; $n++) {
            $house = new House();
            $house->setName('house_' . $n);
            $house->setAddress($this->faker->address);
            $house->setFloors($this->faker->biasedNumberBetween(1, 100));
            $house->setAddress($this->faker->address);
            $house->setCreatedAt($this->faker->dateTime());
            $house->setDeadline($this->faker->dateTimeThisDecade);
            $manager->persist($house);
            $this->addReference('house_' . $n, $house);
        }

        $manager->flush();
    }

    public function loadQuarters(ObjectManager $manager)
    {

        for ($n = 1; $n <= 10; $n++) {
            $quarters = new Quarters();
            $randType = rand(1, 3);
            if ($randType == 1) {
                $quarters->setType($this->getReference('flatType'));
            } elseif ($randType == 2) {
                $quarters->setType($this->getReference('officeType'));
            } else {
                $quarters->setType($this->getReference('parkingType'));
            }
            $quarters->setCreatedAt($this->faker->dateTime());
            $quarters->setFloor($this->faker->biasedNumberBetween(1, 100));
            $quarters->setNumber($this->faker->randomDigit);
            $quarters->setRooms($this->faker->randomDigit);
            $quarters->setPrice($this->faker->biasedNumberBetween(1000000, 100000000));
            $quarters->setSquare($this->faker->biasedNumberBetween(10, 1000));
            $quarters->setHouse($this->getReference('house_' . $n));
            $manager->persist($quarters);
        }

        $manager->flush();
    }


}
