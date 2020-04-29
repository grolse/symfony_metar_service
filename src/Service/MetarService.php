<?php


namespace App\Service;


use App\Entity\Condition;
use App\Entity\Weather;
use App\Entity\Wind;
use App\Exception\IcaoCodeNotFoundException;
use App\Repository\ConditionRepository;
use App\Repository\WeatherRepository;
use App\Repository\WindRepository;
use MetarDecoder\Entity\DecodedMetar;
use Symfony\Component\HttpFoundation\Response;

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
        $visibility = ($metar->getVisibility() != null)
            ? $metar->getVisibility()->getVisibility()->getValue() : 9999;
        $condition->setPressure($metar->getPressure()->getValue())
            ->setTemperature($metar->getAirTemperature()->getValue())
            ->setVisibility($visibility)
            ->setRawMetar($metar->getRawMetar())
            ->setWeather($weather);

        $weather->addWind($wind);
        $weather->addCondition($condition);

        $this->weatherRepository->save($weather);
    }

    public function getWeather(string $icaoCode): Weather
    {
        $icaoCode = strtoupper($icaoCode);
        $weather = $this->weatherRepository->findWeatherByIcao($icaoCode);
        if (!$weather) {
            throw new IcaoCodeNotFoundException(
                Response::HTTP_NOT_FOUND,
                sprintf('%s not found in database', $icaoCode)
            );
        }

        return $weather;
    }

    public function getWeatherByArray(string $icaoCodes)
    {
        $icaoCodes = explode(',',$icaoCodes);

        $codes = "";
        foreach ($icaoCodes as $code) {
            $codes .= strtoupper("'$code',");
        }
        $codes = rtrim($codes, ',');

        return $this->weatherRepository->findWeatherByIcaoCodes($codes);
    }

}