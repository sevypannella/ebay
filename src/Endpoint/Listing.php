<?php

namespace Onetoweb\Ebay\Endpoint;

/**
 * Listing Endpoint
 */
class Listing extends EndpointAbstract
{
    /**
     * Base path
     */
    public const BASE_PATH = '/sell/inventory/v1/bulk_migrate_listing';
    
    /**
     * @param array $data
     */
    public function bulkMigrate(array $data): array
    {
        return $this->client->request($this->client::METHOD_POST, self::BASE_PATH, [], $data);
    }
}