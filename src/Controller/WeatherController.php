<?php

namespace App\Controller;

use App\Service\WeatherService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\ItemInterface;

class WeatherController extends AbstractController
{
    #[Route('/weather', name: 'weather')]
    public function index(WeatherService $weatherService): Response
    {
        $cache = new FilesystemAdapter();

        $cacheKey = 'weather-app-cache-'.$weatherService->ipService->getIPAddress();

        $isCached = $cache->hasItem($cacheKey);

        $data = $cache->get($cacheKey, function (ItemInterface $item) use ($weatherService) {
            $item->expiresAfter(3600);

            return $weatherService->getWeather();
        });

        return $this->json([
            'data' => $data,
            'cached' => $isCached
        ]);
    }
}
