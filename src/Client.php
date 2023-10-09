<?php

namespace Onetoweb\Ebay;

use GuzzleHttp\RequestOptions;
use GuzzleHttp\Client as GuzzleCLient;
use Onetoweb\Ebay\Token;
use Onetoweb\Ebay\Exception\TokenException;
use Onetoweb\Ebay\Endpoint;
use DateTime;

/**
 * Ebay Api Client.
 */
class Client
{
    /**
     * Methods.
     */
    public const METHOD_GET = 'GET';
    public const METHOD_POST = 'POST';
    public const METHOD_PUT = 'PUT';
    public const METHOD_DELETE = 'DELETE';
    
    /**
     * @var string
     */
    private $clientId;
    
    /**
     * @var string
     */
    private $clientSecret;
    
    /**
     * @var string
     */
    private $redirectRuName;
    
    /**
     * @var bool
     */
    private $sandbox;
    
    /**
     * @var callable
     */
    private $tokenUpdateCallback;
    
    /**
     * @var Token
     */
    private $token;
    
    /**
     * @var string
     */
    private $contentLanguage;
    
    /**
     * @param string $clientId
     * @param string $clientSecret
     * @param string $redirectRuName
     * @param bool $sandbox = false
     */
    public function __construct(string $clientId, string $clientSecret, string $redirectRuName, bool $sandbox = false)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->redirectRuName = $redirectRuName;
        $this->sandbox = $sandbox;
        
        $this->loadEndpoints();
    }
    
    /**
     * @return void
     */
    private function loadEndpoints(): void
    {
        $this->inventory = new Endpoint\Inventory($this);
    }
    
    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->sandbox ? 'https://api.sandbox.ebay.com' : 'https://api.ebay.com';
    }
    
    /**
     * @return string
     */
    public function getAuthUrl(): string
    {
        return ($this->sandbox ? 'https://auth.sandbox.ebay.com' : 'https://auth.ebay.com') . '/oauth2/authorize';
    }
    
    /**
     * @param callable $tokenUpdateCallback
     * 
     * @return void
     */
    public function setTokenUpdateCallback(callable $tokenUpdateCallback): void
    {
        $this->tokenUpdateCallback = $tokenUpdateCallback;
    }
    
    /**
     * @param string $contentLanguage
     * 
     * @return void
     */
    public function setContentLanguage(string $contentLanguage): void
    {
        $this->contentLanguage = $contentLanguage;
    }
    
    /**
     * @param string[]
     */
    public static function getScopes()
    {
        return [
            'https://api.ebay.com/oauth/api_scope',
            'https://api.ebay.com/oauth/api_scope/buy.order.readonly',
            'https://api.ebay.com/oauth/api_scope/buy.guest.order',
            'https://api.ebay.com/oauth/api_scope/sell.marketing.readonly',
            'https://api.ebay.com/oauth/api_scope/sell.marketing',
            'https://api.ebay.com/oauth/api_scope/sell.inventory.readonly',
            'https://api.ebay.com/oauth/api_scope/sell.inventory',
            'https://api.ebay.com/oauth/api_scope/sell.account.readonly',
            'https://api.ebay.com/oauth/api_scope/sell.account',
            'https://api.ebay.com/oauth/api_scope/sell.fulfillment.readonly',
            'https://api.ebay.com/oauth/api_scope/sell.fulfillment',
            'https://api.ebay.com/oauth/api_scope/sell.analytics.readonly',
            'https://api.ebay.com/oauth/api_scope/sell.marketplace.insights.readonly',
            'https://api.ebay.com/oauth/api_scope/commerce.catalog.readonly',
            'https://api.ebay.com/oauth/api_scope/buy.shopping.cart',
            'https://api.ebay.com/oauth/api_scope/buy.offer.auction',
            'https://api.ebay.com/oauth/api_scope/commerce.identity.readonly',
            'https://api.ebay.com/oauth/api_scope/commerce.identity.email.readonly',
            'https://api.ebay.com/oauth/api_scope/commerce.identity.phone.readonly',
            'https://api.ebay.com/oauth/api_scope/commerce.identity.address.readonly',
            'https://api.ebay.com/oauth/api_scope/commerce.identity.name.readonly',
            'https://api.ebay.com/oauth/api_scope/commerce.identity.status.readonly',
            'https://api.ebay.com/oauth/api_scope/sell.finances',
            'https://api.ebay.com/oauth/api_scope/sell.item.draft',
            'https://api.ebay.com/oauth/api_scope/sell.payment.dispute',
            'https://api.ebay.com/oauth/api_scope/sell.item',
            'https://api.ebay.com/oauth/api_scope/sell.reputation',
            'https://api.ebay.com/oauth/api_scope/sell.reputation.readonly',
            'https://api.ebay.com/oauth/api_scope/commerce.notification.subscription',
            'https://api.ebay.com/oauth/api_scope/commerce.notification.subscription.readonly'
        ];
    }
    
    /**
     * @param string $state = null
     * 
     * @return string
     */
    public function getAuthorizationUrl(string $state = null): string
    {
        return $this->getAuthUrl() . '?' . http_build_query([
            'client_id' => $this->clientId,
            'prompt' => 'login',
            'redirect_uri' => $this->redirectRuName,
            'response_type' => 'code',
            'scope' => implode(' ', self::getScopes()),
            'state' => $state
        ]);
    }
    
    /**
     * @param string $code
     * 
     * @return void
     */
    public function requestAccessToken(string $code): void
    {
        // auth url
        $authUrl = $this->getBaseUrl() . '/identity/v1/oauth2/token';
        
        // build options
        $options = [
            RequestOptions::HTTP_ERRORS => false,
            RequestOptions::AUTH => [
                $this->clientId,
                $this->clientSecret
            ],
            RequestOptions::FORM_PARAMS => [
                'grant_type' => 'authorization_code',
                'redirect_uri' => $this->redirectRuName,
                'code' => $code
            ]
        ];
        
        // request access token
        $response = (new GuzzleCLient())->post($authUrl, $options);
        
        // get contents
        $contents = $response->getBody()->getContents();
        $tokenArray = json_decode($contents, true);
        
        // get expires at
        $expires = ($tokenArray['expires_in'] - 3);
        $expiresAt = (new DateTime())->modify("+$expires seconds");
        
        // create token
        $this->token = new Token($tokenArray['access_token'], $expiresAt, $tokenArray['refresh_token']);
        
        // call token update callback
        ($this->tokenUpdateCallback)($this->token);
    }
    
    /**
     * @return void
     */
    public function refreshAccessToken(): void
    {
        // auth url
        $authUrl = $this->getBaseUrl() . '/identity/v1/oauth2/token';
        
        // build options
        $options = [
            RequestOptions::HTTP_ERRORS => false,
            RequestOptions::AUTH => [
                $this->clientId,
                $this->clientSecret
            ],
            RequestOptions::FORM_PARAMS => [
                'grant_type' => 'refresh_token',
                'refresh_token' => $this->token->getRefreshToken(),
                'scope' => self::getScopes()
            ]
        ];
        
        // request access token
        $response = (new GuzzleCLient())->post($authUrl, $options);
        
        // get contents
        $contents = $response->getBody()->getContents();
        $tokenArray = json_decode($contents, true);
        
        // get expires at
        $expires = ($tokenArray['expires_in'] - 3);
        $expiresAt = (new DateTime())->modify("+$expires seconds");
        
        // create token
        $this->token = new Token($tokenArray['access_token'], $expiresAt, $this->token->getRefreshToken());
        
        // call token update callback
        ($this->tokenUpdateCallback)($this->token);
    }
    
    /**
     * @param Token $token
     * 
     * @return void
     */
    public function setToken(Token $token): void
    {
        $this->token = $token;
    }
    
    /**
     * @return Token|null
     */
    public function getToken(): ?Token
    {
        return $this->token;
    }
    
    /**
     * @param string $method
     * @param string $endpoint
     * @param array $query = []
     * @param array $data = []
     * 
     * @throws TokenException if no token is set
     * 
     * @return mixed
     */
    public function request(string $method, string $endpoint, array $query = [], array $data = [])
    {
        if ($this->token === null) {
            throw new TokenException('no access token is set');
        }
        
        if( $this->token->isExpired()) {
            $this->refreshAccessToken();
        }
        
        // build headers
        $headers = [
            'Authorization' => "Bearer {$this->token->getValue()}",
            'Content-Type' => 'application/json',
        ];
        
        if ($this->contentLanguage) {
            $headers['Content-Language'] = $this->contentLanguage;
        }
        
        // build options
        $options = [
            RequestOptions::HTTP_ERRORS => false,
            RequestOptions::QUERY => $query,
            RequestOptions::HEADERS => $headers,
            RequestOptions::JSON => $data
        ];
        
        // get url
        $url = $this->getBaseUrl() . $endpoint;
        
        
        // DEV - DEV - DEV
        dump([
            'method' => $method,
            'url' => $url,
            'options' => $options
        ]);
        // DEV - DEV - DEV
        
        
        // request
        $response = (new GuzzleCLient())->request($method, $url, $options);
        
        
        // DEV - DEV - DEV
        dump($response);
        // DEV - DEV - DEV
        
        
        // get contents
        $contents = $response->getBody()->getContents();
        
        return json_decode($contents, true);
    }
}