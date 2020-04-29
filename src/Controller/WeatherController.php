<?php

namespace App\Controller;

use App\Exception\IcaoCodeNotFoundException;
use App\Service\MetarServiceInterface;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class WeatherController
 * @package App\Controller
 *
 * @Route("/api")
 */
class WeatherController extends AbstractController
{
    /** @var MetarServiceInterface  */
    private $metarService;

    /**
     * WeatherController constructor.
     * @param MetarServiceInterface $metarService
     */
    public function __construct(MetarServiceInterface $metarService)
    {
        $this->metarService = $metarService;
    }

    /**
     * @param string $icaoCode
     * @return JsonResponse
     *
     * @Route("/weather/{icaoCode}", methods={"GET"})
     */
    public function getWeather(string $icaoCode, SerializerInterface $serializer): JsonResponse
    {
        try {
            $weather = $this->metarService->getWeather($icaoCode);
            $weather = $serializer->serialize($weather, 'json');
            return new JsonResponse($weather, Response::HTTP_OK, [], true);
        } catch (IcaoCodeNotFoundException $e) {
            return $this->json([
                'error' => $e->getMessage()
            ], $e->getStatusCode());
        }
    }

    /**
     * @param string $icaoCodes
     * @param SerializerInterface $serializer
     * @return JsonResponse
     *
     * @Route("/weathers/{icaoCodes}", methods={"GET"})
     *
     */
    public function getWeatherByCodes(string $icaoCodes, SerializerInterface $serializer): JsonResponse
    {
        $weather = $this->metarService->getWeatherByArray($icaoCodes);
        $weather = $serializer->serialize($weather, 'json');
        return new JsonResponse($weather, Response::HTTP_OK, [], true);
    }
}
