<?php
namespace App\Service;

use Symfony\Component\HttpFoundation\RequestStack;

class UserIPService
{
    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * @var string 
     */
    private $ipOverride;

    /**
     * Initialize class
     *
     * @param RequestStack $requestStack
     */
    public function __construct(string $ipOverride, RequestStack $requestStack)
    {
        $this->ipOverride = $ipOverride;

        $this->requestStack = $requestStack;
    }

    /**
     * Return Current request user IP
     *
     * @return string
     */
    public function getIPAddress(): string
    {
        $currentRequest = $this->requestStack->getCurrentRequest();

        // dummy override for local IP test
        if ($this->ipOverride) {
            $currentRequest->server->set('REMOTE_ADDR', $this->ipOverride);
        }

        return $currentRequest->getClientIp();
    }
}