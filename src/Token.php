<?php

namespace Onetoweb\Ebay;

use GuzzleHttp\RequestOptions;
use GuzzleHttp\Client as GuzzleCLient;
use Stringable;
use DateTime;

/**
 * Token
 */
class Token implements Stringable
{
    /**
     * @var string
     */
    private $value;
    
    /**
     * @var DateTime
     */
    private $expiresAt;
    
    /**
     * @var string
     */
    private $refreshToken;
    
    /**
     * @param string $value
     * @param DateTime $expiresAt
     * @param string $refreshToken
     */
    public function __construct(string $value, DateTime $expiresAt, string $refreshToken)
    {
        $this->value = $value;
        $this->expiresAt = $expiresAt;
        $this->refreshToken = $refreshToken;
    }
    
    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
    
    /**
     * @return DateTime
     */
    public function getExpiresAt(): DateTime
    {
        return $this->expiresAt;
    }
    
    /**
     * @return bool
     */
    public function isExpired(): bool
    {
        return new DateTime() > $this->expiresAt;
    }
    
    /**
     * @return string
     */
    public function getRefreshToken(): string
    {
        return $this->refreshToken;
    }
    
    /**
     * @return string
     */
    public function __toString(): string
    {
        $this->getValue();
    }
}