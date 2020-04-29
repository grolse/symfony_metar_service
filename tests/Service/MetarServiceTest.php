<?php


namespace App\Tests\Service;


use App\Entity\Weather;
use App\Exception\IcaoCodeNotFoundException;
use App\Service\MetarService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MetarServiceTest extends WebTestCase
{
    private $service;

    public function setUp()
    {
        self::bootKernel();
        $this->service = self::$container->get(MetarService::class);
    }

    public function testGetByIcao()
    {
        /** @var Weather $weather */
        $weather = $this->service->getWeather('UKDR');
        $this->assertEquals('UKDR', $weather->getIcaoCode());

        $weather = $this->service->getWeather('UKOO');
        $this->assertEquals('UKOO', $weather->getIcaoCode());
    }

    public function testGetByIcaoFailed()
    {
        $this->expectException(IcaoCodeNotFoundException::class);
        $this->expectExceptionMessage('XXXX not found in database');
        $this->service->getWeather('XXXX');
    }
}