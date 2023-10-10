<?php

namespace Onetoweb\Ebay\Endpoint;

/**
 * Offer Endpoint
 */
class Offer extends EndpointAbstract
{
    /**
     * Base path
     */
    public const BASE_PATH = '/sell/inventory/v1';
    
    /**
     * @param array $data
     * 
     * @return array
     */
    public function create(array $data): array
    {
        return $this->client->request($this->client::METHOD_POST, self::BASE_PATH . '/offer', [], $data);
    }
    
    /**
     * @param string $offerId
     * 
     * @return array
     */
    public function get(string $offerId): array
    {
        return $this->client->request($this->client::METHOD_GET, self::BASE_PATH . "/offer/$offerId");
    }
    
    /**
     * @param string $offerId
     * @param array $data
     */
    public function update(string $offerId, array $data)
    {
        return $this->client->request($this->client::METHOD_PUT, self::BASE_PATH . "/offer/$offerId", [], $data);
    }
    
    /**
     * @param string $offerId
     * 
     * @return array
     */
    public function delete(string $offerId): array
    {
        return $this->client->request($this->client::METHOD_DELETE, self::BASE_PATH . "/offer/$offerId");
    }
    
    /**
     * @param string $offerId
     * 
     * @return array
     */
    public function publish(string $offerId): array
    {
        return $this->client->request($this->client::METHOD_POST, self::BASE_PATH . "/offer/$offerId/publish");
    }
    
    /**
     * @param string $offerId
     * 
     * @return array
     */
    public function withdraw(string $offerId): array
    {
        return $this->client->request($this->client::METHOD_POST, self::BASE_PATH . "/offer/$offerId/withdraw");
    }
    
    /**
     * @param array $query = []
     * 
     * @return array
     */
    public function list(array $query = []): array
    {
        return $this->client->request($this->client::METHOD_GET, self::BASE_PATH . '/offer', $query);
    }
    
    /**
     * @param array $data
     * 
     * @return array
     */
    public function getListingFees(array $data): array
    {
        return $this->client->request($this->client::METHOD_POST, self::BASE_PATH . '/offer/get_listing_fees', [], $data);
    }
    
    /**
     * @param array $data
     * 
     * @return array
     */
    public function bulkCreate(array $data): array
    {
        return $this->client->request($this->client::METHOD_POST, self::BASE_PATH . '/bulk_create_offer', [], $data);
    }
    
    /**
     * @param array $data
     * 
     * @return array
     */
    public function bulkPublish(array $data): array
    {
        return $this->client->request($this->client::METHOD_POST, self::BASE_PATH . '/bulk_publish_offer', [], $data);
    }
    
    /**
     * @param array $data
     * 
     * @return array
     */
    public function publishByInventoryItemGroup(array $data): array
    {
        return $this->client->request($this->client::METHOD_POST, self::BASE_PATH . '/offer/publish_by_inventory_item_group', [], $data);
    }
    
    /**
     * @param array $data
     * 
     * @return array
     */
    public function withdrawByInventoryItemGroup(array $data): array
    {
        return $this->client->request($this->client::METHOD_POST, self::BASE_PATH . '/offer/withdraw_by_inventory_item_group', [], $data);
    }
}