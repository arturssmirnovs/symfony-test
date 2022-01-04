<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CacheController extends AbstractController
{
    #[Route('/cache', name: 'cache')]
    public function index(): Response
    {
        $cache = new FilesystemAdapter();

        return $this->json([
            'success' => $cache->clear()
        ]);
    }
}
