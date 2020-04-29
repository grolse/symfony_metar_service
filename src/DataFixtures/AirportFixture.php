<?php


namespace App\DataFixtures;


use App\Entity\Weather;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AirportFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $weather = new Weather();
        $weather->setIcaoCode('UKOO');

        $manager->persist($weather);

        $weatherUkdr = new Weather();
        $weatherUkdr->setIcaoCode('UKDR');

        $manager->persist($weatherUkdr);
        $manager->flush();
    }
}