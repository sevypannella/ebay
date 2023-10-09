<?php

namespace Onetoweb\Ebay\Endpoint;

use Onetoweb\Ebay\Client;

/**
 * Endpoint Abstract
 */
abstract class EndpointAbstract
{
    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
}