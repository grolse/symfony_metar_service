<?php


namespace App\Service;


use App\Entity\Condition;
use App\Entity\Weather;
use App\Entity\Wind;
use App\Repository\ConditionRepository;
use App\Repository\WeatherRepository;
use App\Repository\WindRepository;
use MetarDecoder\Entity\DecodedMetar;

class MetarService implements MetarServiceInterface
{
    private $weatherRepository;

    private $windRepository;
    private $conditionRepository;

    public function __construct(
        WeatherRepository $weatherRepository,
        WindRepository $windRepository,
        ConditionRepository $conditionRepository)
    {
        $this->weatherRepository = $weatherRepository;
        $this->conditionRepository = $conditionRepository;
        $this->windRepository = $windRepository;
    }

    public function addWeather(DecodedMetar $metar): void
    {
        $weather = new Weather();
        $weather->setIcaoCode($metar->getIcao());

        $wind = new Wind();

        $speedVariations = ($metar->getSurfaceWind()->getSpeedVariations() != null)
            ? $metar->getSurfaceWind()->getSpeedVariations()->getValue() : 0;

        $wind->setHeading($metar->getSurfaceWind()->getMeanDirection()->getValue())
            ->setSpeed($metar->getSurfaceWind()->getMeanSpeed()->getValue())
            ->setGusts($speedVariations)
            ->setWeather($weather);

        $condition = new Condition();
        $condition->setPressure($metar->getPressure()->getValue())
            ->setTemperature($metar->getAirTemperature()->getValue())
            ->setVisibility($metar->getVisibility()->getVisibility()->getValue())
            ->setRawMetar($metar->getRawMetar())
            ->setWeather($weather);

        $weather->addWind($wind);
        $weather->addCondition($condition);

        $this->weatherRepository->save($weather);
    }

    public function getWeather(string $icaoCode): Weather
    {
        // TODO: Implement getWeather() method.
    }

    public function getWeatherByArray(array $icaoCodes)
    {
        // TODO: Implement getWeatherByArray() method.
    }

}