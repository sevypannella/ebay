.. title:: Index

===========
Basic Usage
===========

Setup client

.. code-block:: php
    
    require 'vendor/autoload.php';
    
    session_start();
    
    use Onetoweb\Ebay\{Client, Token};
    
    // param
    $clientId = 'client_id';
    $clientSecret = 'client_secret';
    $redirectRuName = 'redirect_ru_name';
    $sandbox = true;
    
    // setup client
    $client = new Client($clientId, $clientSecret, $redirectRuName, $sandbox);
    
    // set content language
    $client->setContentLanguage('en-US');
    
    // setup token update callback
    $client->setTokenUpdateCallback(function(Token $token) {
        
        // store token
        $_SESSION['token'] = [
            'value' => $token->getValue(),
            'expires_at' => $token->getExpiresAt(),
            'refresh_token' => $token->getRefreshToken(),
        ];
    });
    
    // load token from storage
    if (isset($_SESSION['token'])) {
        
        // build token
        $token = new Token(
            $_SESSION['token']['value'],
            $_SESSION['token']['expires_at'],
            $_SESSION['token']['refresh_token']
        );
        
        // set token
        $client->setToken($token);
        
    } elseif (isset($_GET['code'])) {
        
        // request access token with authorization code
        $client->requestAccessToken($_GET['code']);
        
    } elseif (!isset($_SESSION['token'])) {
        
        // redirect to authorization prompt to request user authorization
        header("Location: {$client->getAuthorizationUrl()}");
        exit;
    }


=================
Endpoint Examples
=================

* `Inventory Item <inventory_item.rst>`_
* `Inventory Item Group <inventory_item_group.rst>`_
* `Listing <listing.rst>`_
* `Offer <offer.rst>`_
