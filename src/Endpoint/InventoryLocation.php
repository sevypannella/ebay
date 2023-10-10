<?php

namespace Onetoweb\Ebay\Endpoint;

/**
 * Inventory Location Endpoint
 */
class InventoryLocation extends EndpointAbstract
{
    /**
     * Base path
     */
    public const BASE_PATH = '/sell/inventory/v1';
    
    /**
     * @param array $query = []
     */
    public function list(array $query = [])
    {
        return $this->client->request($this->client::METHOD_GET, self::BASE_PATH . '/location', $query);
    }
    
    /**
     * @param string $merchantLocationKey
     */
    public function get(string $merchantLocationKey)
    {
        return $this->client->request($this->client::METHOD_GET, self::BASE_PATH . "/location/$merchantLocationKey");
    }
    
    /**
     * @param string $merchantLocationKey
     * @param array $data
     */
    public function create(string $merchantLocationKey, array $data)
    {
        return $this->client->request($this->client::METHOD_POST, self::BASE_PATH . "/location/$merchantLocationKey", [], $data);
    }
    
    /**
     * @param string $merchantLocationKey
     * @param array $data
     */
    public function update(string $merchantLocationKey, array $data)
    {
        return $this->client->request($this->client::METHOD_POST, self::BASE_PATH . "/location/$merchantLocationKey/update_location_details", [], $data);
    }
    
    /**
     * @param string $merchantLocationKey
     */
    public function delete(string $merchantLocationKey)
    {
        return $this->client->request($this->client::METHOD_DELETE, self::BASE_PATH . "/location/$merchantLocationKey");
    }
    
    /**
     * @param string $merchantLocationKey
     */
    public function enable(string $merchantLocationKey)
    {
        return $this->client->request($this->client::METHOD_POST, self::BASE_PATH . "/location/$merchantLocationKey/enable");
    }
    
    /**
     * @param string $merchantLocationKey
     */
    public function disable(string $merchantLocationKey)
    {
        return $this->client->request($this->client::METHOD_POST, self::BASE_PATH . "/location/$merchantLocationKey/disable");
    }
}