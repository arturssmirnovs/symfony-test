<?php
namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class WeatherService
{
    /**
     * @var UserIPService
     */
    public $ipService;

    /**
     * @var LocationService
     */
    public $locationService;

    /**
     * @var string
     */
    private $openWeatherAccessKey;

    /**
     * @var HttpClientInterface
     */
    private $client;

    /**
     * Initialize class
     *
     * @param string $openWeatherAccessKey
     * @param UserIPService $userIPService
     * @param LocationService $locationService
     * @param HttpClientInterface $client
     */
    public function __construct(string $openWeatherAccessKey, UserIPService $userIPService, LocationService $locationService, HttpClientInterface $client)
    {
        $this->openWeatherAccessKey = $openWeatherAccessKey;
        $this->ipService = $userIPService;
        $this->locationService = $locationService;
        $this->client = $client;
    }

    /**
     * Return weather data
     *
     * @return array
     */
    public function getWeather(): array
    {
        $this->locationService->getLocation();

        $response = $this->client->request(
            'GET',
            'https://api.openweathermap.org/data/2.5/weather', [
            'query' => [
                'q' => $this->locationService->getFormattedLocation(),
                'appid' => $this->openWeatherAccessKey
            ],
        ]);

        return $response->toArray();
    }
}