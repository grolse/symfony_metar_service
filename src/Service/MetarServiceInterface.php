<?php


namespace App\Service;


use App\Entity\Weather;
use MetarDecoder\Entity\DecodedMetar;

interface MetarServiceInterface
{
    /**
     * Add weather.
     *
     * @param DecodedMetar $metar
     */
    public function addWeather(DecodedMetar $metar): void;

    /**
     * Get weather.
     *
     * @param string $icaoCode
     * @return Weather
     */
    public function getWeather(string $icaoCode): Weather;

    /**
     * Get weather by multiple airports.
     * @param string $icaoCodes
     * @return mixed
     */
    public function getWeatherByArray(string $icaoCodes);
}