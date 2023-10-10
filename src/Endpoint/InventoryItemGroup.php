<?php

namespace Onetoweb\Ebay\Endpoint;

/**
 * Inventory Endpoint
 */
class InventoryItemGroup extends EndpointAbstract
{
    /**
     * Base path
     */
    public const BASE_PATH = '/sell/inventory/v1';
    
    /**
     * @param string $inventoryItemGroupKey
     */
    public function createOrReplace(string $inventoryItemGroupKey, array $data)
    {
        return $this->client->request($this->client::METHOD_PUT, self::BASE_PATH . "/inventory_item_group/$inventoryItemGroupKey", [], $data);
    }
    
    /**
     * @param string $inventoryItemGroupKey
     */
    public function get(string $inventoryItemGroupKey)
    {
        return $this->client->request($this->client::METHOD_GET, self::BASE_PATH . "/inventory_item_group/$inventoryItemGroupKey");
    }
    
    /**
     * @param string $inventoryItemGroupKey
     */
    public function delete(string $inventoryItemGroupKey)
    {
        return $this->client->request($this->client::METHOD_DELETE, self::BASE_PATH . "/inventory_item_group/$inventoryItemGroupKey");
    }
}