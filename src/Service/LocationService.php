<?php
namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class LocationService
{
    /**
     * @var UserIPService
     */
    private $userIPService;

    /**
     * @var HttpClientInterface
     */
    private $client;

    /**
     * @var string
     */
    private $ipStackAccessKey;

    /**
     * @var null[]
     */
    private $data = [
        'region_name' => null,
        'country_name' => null
    ];

    /**
     * Initialize class
     *
     * @param string $ipStackAccessKey
     * @param UserIPService $userIPService
     * @param HttpClientInterface $client
     */
    public function __construct(string $ipStackAccessKey, UserIPService $userIPService, HttpClientInterface $client)
    {
        $this->ipStackAccessKey = $ipStackAccessKey;

        $this->userIPService = $userIPService;

        $this->client = $client;
    }

    /**
     * Return array of location data
     *
     * @return array
     */
    public function getLocation(): array
    {
        $response = $this->client->request(
            'GET',
            'http://api.ipstack.com/'.$this->userIPService->getIPAddress(), [
            'query' => [
                'access_key' => $this->ipStackAccessKey
            ],
        ]);

        $this->data = $response->toArray();

        return $this->data;
    }

    /**
     * Return formatted location for query searching
     *
     * @return string
     */
    public function getFormattedLocation(): string
    {
        return $this->data['region_name'].', '.$this->data['country_name'];
    }
}