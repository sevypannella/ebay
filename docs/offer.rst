.. _top:
.. title:: Offer

`Back to index <index.rst>`_

=====
Offer
=====

.. contents::
    :local:


Create Offer
````````````

.. code-block:: php
    
    $result = $client->offer->create([
        'sku' => 'G********1',
        'marketplaceId' => 'EBAY_US',
        'format' => 'FIXED_PRICE',
        'availableQuantity' => 75,
        'categoryId' => '30120',
        'listingDescription' => 'Lumia phone with a stunning 5.7 inch Quad HD display and a powerful octa-core processor.',
        'listingPolicies' => [
            'fulfillmentPolicyId' => null,
            'paymentPolicyId' => null,
            'returnPolicyId' => null,
        ],
        'pricingSummary' => [
            'price' => [
                'currency' => 'USD',
                'value' => '272.17'
            ]
        ],
        'quantityLimitPerBuyer' => 2,
        'includeCatalogProductDetails' => true
    ]);


Get Offer
`````````

.. code-block:: php
    
    $offerId = '8496884010';
    $result = $client->offer->get($offerId);


Update Offer
````````````

.. code-block:: php
    
    $offerId = '8496884010';
    $result = $client->offer->update($offerId, [
        'availableQuantity' => 60,
        'categoryId' => '30120',
        'listingDescription' => 'Lumia phone with a stunning 5.7 inch Quad HD display and a powerful octa-core processor.',
        'listingPolicies' => [
            'fulfillmentPolicyId' => null,
            'paymentPolicyId' => null,
            'returnPolicyId' => null,
        ],
        'pricingSummary' => [
            'price' => [
                'currency' => 'USD',
                'value' => '260.00'
            ]
        ],
        'quantityLimitPerBuyer' => 3,
        'includeCatalogProductDetails' => true
    ]);


Delete Offer
````````````

.. code-block:: php
    
    $offerId = '8496884010';
    $result = $client->offer->delete($offerId);


Publish Offer
`````````````

.. code-block:: php
    
    $offerId = '8496884010';
    $result = $client->offer->publish($offerId);


Withdraw Offer
``````````````

.. code-block:: php
    
    $offerId = '8496884010';
    $result = $client->offer->withdraw($offerId);


List Offers
```````````

.. code-block:: php
    
    $result = $client->offer->list([
        'sku' => 'G********1',
        'limit' => 10,
        'offset' => 0
    ]);


Get Listing Fees
````````````````

.. code-block:: php
    
    $result = $client->offer->getListingFees([
        'offers' => [[
            'offerId' => '8496884010'
        ]]
    ]);


Bulk Create Offers
``````````````````

.. code-block:: php
    
    $result = $client->offer->bulkCreate([
        'requests' => [
            [
                'sku' => 'G********1',
                'marketplaceId' => 'EBAY_US',
                'format' => 'FIXED_PRICE',
                'categoryId' => '30120',
                'pricingSummary' => [
                    'price' => [
                        'value' => '100',
                        'currency' => 'USD'
                    ],
                    'originalRetailPrice' => [
                        'value' => '120',
                        'currency' => 'USD'
                    ],
                    'minimumAdvertisedPrice' => [
                        'value' => '95',
                        'currency' => 'USD'
                    ],
                    'pricingVisibility' => 'PRE_CHECKOUT',
                    'originallySoldForRetailPriceOn' => 'ON_EBAY'
                ],
                'storeCategoryNames' => [
                    'shirts',
                    'accessories'
                ],
                'listingPolicies' => [
                    'fulfillmentPolicyId' => '7********1',
                    'returnPolicyId' => '6********1',
                    'paymentPolicyId' => '6********1',
                    'shippingCostOverrides' => [
                        [
                            'shippingCost' => [
                                'value' => '0',
                                'currency' => 'USD'
                            ],
                            'additionalShippingCost' => [
                                'value' => '0',
                                'currency' => 'USD'
                            ],
                            'priority' => 1,
                            'shippingServiceType' => 'DOMESTIC'
                        ]
                    ]
                ],
                'tax' => [
                    'applyTax' => true
                ],
                'listingDescription' => 'With a stunning 5.7 inch Quad HD display and a powerful octa-core processor, it\'s the Lumia you\'ve been waiting for. Get the phone that works like your PC and push the limits of what\'s possible.',
                'quantityLimitPerBuyer' => 5,
                'merchantLocationKey' => 'S****1',
                'includeCatalogProductDetails' => false
            ],
            [
                'sku' => 'J********h',
                'marketplaceId' => 'EBAY_US',
                'format' => 'FIXED_PRICE',
                'categoryId' => '30120',
                'pricingSummary' => [
                    'price' => [
                        'value' => 100,
                        'currency' => 'USD'
                    ],
                    'originalRetailPrice' => [
                        'value' => 120,
                        'currency' => 'USD'
                    ],
                    'minimumAdvertisedPrice' => [
                        'value' => 95,
                        'currency' => 'USD'
                    ],
                    'pricingVisibility' => 'PRE_CHECKOUT',
                    'originallySoldForRetailPriceOn' => 'ON_EBAY'
                ],
                'listingPolicies' => [
                    'fulfillmentPolicyId' => '7********1',
                    'returnPolicyId' => '6********1',
                    'paymentPolicyId' => '6********1',
                    'shippingCostOverrides' => [
                        [
                            'shippingCost' => [
                                'value' => 0,
                                'currency' => 'USD'
                            ],
                            'additionalShippingCost' => [
                                'value' => 0,
                                'currency' => 'USD'
                            ],
                            'priority' => 1,
                            'shippingServiceType' => 'DOMESTIC'
                        ]
                    ]
                ],
                'taxDetails' => [
                    'applyTax' => true
                ],
                'listingDescription' => 'With a stunning 5.7 inch Quad HD display and a powerful octa-core processor, it\'s the Lumia you\'ve been waiting for. Get the phone that works like your PC and push the limits of what\'s possible.',
                'quantityLimitPerBuyer' => 5,
                'merchantLocationKey' => 'S****1',
                'includeCatalogProductDetails' => true
            ]
        ]
    ]);


Bulk Publish Offers
```````````````````

.. code-block:: php
    
    $result = $client->offer->bulkPublish([
        'requests' => [[
            'offerId' => '8496884010'
        ]]
    ]);


Publish Offers By Inventory Item Group
``````````````````````````````````````

.. code-block:: php
    
    $result = $client->offer->publishByInventoryItemGroup([
        'inventoryItemGroupKey' => '0*********1_GRP',
        'marketplaceId' => 'EBAY_US'
    ]);


Withdraw Offers By Inventory Item Group
```````````````````````````````````````

.. code-block:: php
    
    $result = $client->offer->withdrawByInventoryItemGroup([
        'inventoryItemGroupKey' => '0*********1_GRP',
        'marketplaceId' => 'EBAY_US'
    ]);


`Back to top <#top>`_