.. _top:
.. title:: Inventory Items

`Back to index <index.rst>`_

===============
Inventory Items
===============

.. contents::
    :local:


List Inventory Items
````````````````````

.. code-block:: php
    
    $result = $client->inventory->list([
        'limit' => 10,
        'offset' => 0,
    ]);


Create Inventory In Bulk
````````````````````````

.. code-block:: php
    
    $result = $client->inventory->bulkCreateOrReplace( [
        'requests' => [
            [
                'sku' => 'B********s',
                'locale' => 'en_US',
                'product' => [
                    'title' => 'Boston Terriers Collector Plate &quot;All Ears by Dan Hatala - The Danbury Mint',
                    'aspects' => [
                        'Country/Region of Manufacture' => [
                            'United States'
                        ]
                    ],
                    'description' => 'All Ears by Dan Hatala. A limited edition from the collection entitled \'Boston Terriers\'. Presented by The Danbury Mint.',
                    'imageUrls' => [
                        'https://picsum.photos/200'
                    ]
                ],
                'condition' => 'USED_EXCELLENT',
                'conditionDescription' => 'Mint condition. Kept in styrofoam case. Never displayed.',
                'availability' => [
                    'shipToLocationAvailability' => [
                        'quantity' => 2
                    ]
                ]
            ],
            [
                'sku' => 'J********h',
                'locale' => 'en_US',
                'product' => [
                    'title' => 'JOE PAVELSKI 2015-16 BOBBLEHEAD NHL SAN JOSE SHARKS 25TH ANNIVERSARY',
                    'aspects' => [
                        'Team' => [
                            'San Jose Sharks'
                        ],
                        'Player' => [
                            'Joe Pavelski'
                        ],
                        'Pre & Post Season' => [
                            'Regular Season'
                        ],
                        'Product' => [
                            'Bobblehead'
                        ],
                        'Country/Region of Manufacture' => [
                            'China'
                        ],
                        'Brand' => [
                            'Success Promotions'
                        ],
                        'UPC' => [
                            'Does not apply'
                        ]
                    ],
                    'description' => 'Joe Pavelski bobble head from 2015-16 season, the 25th season of the San Jose Sharks. New in box.',
                    'imageUrls' => [
                        'https://picsum.photos/200'
                    ]
                ],
                'condition' => 'NEW',
                'availability' => [
                    'shipToLocationAvailability' => [
                        'quantity' => 1
                    ]
                ]
            ]
        ]
    ]);


Get Inventory Item
``````````````````

.. code-block:: php
    
    $sku = 'B********s';
    $result = $client->inventory->get($sku);


Delete Inventory Item
`````````````````````

.. code-block:: php
    
    $sku = 'B********s';
    $client->inventory->delete($sku);


Bulk Get Inventory Items
````````````````````````

.. code-block:: php
    
    $result = $client->inventory->bulkGetItems([
        'requests' => [
            [
                'sku' => 'B********s'
            ],
            [
                'sku' => 'J********h'
            ]
        ]
    ]);


Bulk Update Price Quantity
``````````````````````````

.. code-block:: php
    
    $result = $client->inventory->bulkUpdatePriceQuantity([
        'requests' => [
            [
                'offers' => [
                    [
                        'availableQuantity' => 30,
                        'offerId' => '3********5',
                        'price' => [
                            'currency' => 'USD',
                            'value' => '299.0'
                        ]
                    ],
                    [
                        'availableQuantity' => 20,
                        'offerId' => '3********2',
                        'price' => [
                            'currency' => 'GBP',
                            'value' => '232.0'
                        ]
                    ]
                ],
                'shipToLocationAvailability' => [
                    'quantity' => 50
                ],
                'sku' => 'G********1'
            ],
            [
                'offers' => [
                    [
                        'availableQuantity' => 15,
                        'offerId' => '3********3',
                        'price' => [
                            'currency' => 'USD',
                            'value' => '249.0'
                        ]
                    ],
                    [
                        'availableQuantity' => 10,
                        'offerId' => '3********4',
                        'price' => [
                            'currency' => 'GBP',
                            'value' => '182.0'
                        ]
                    ]
                ],
                'shipToLocationAvailability' => [
                    'quantity' => 25
                ],
                'sku' => 'G********2'
            ]
        ]
    ]);


Replace Or create
`````````````````

.. code-block:: php
    
    $sku = 'G********1';
    $client->inventory->replaceOrCreate($sku, [
        'availability' => [
            'shipToLocationAvailability' => [
                'quantity' => 50
            ]
        ],
        'condition' => 'NEW',
        'product' => [
            'title' => 'GoPro Hero4 Helmet Cam',
            'description' => 'New GoPro Hero4 Helmet Cam. Unopened box.',
            'aspects' => [
                'Brand' => [
                    'GoPro'
                ],
                'Type' => [
                    'Helmet/Action'
                ],
                'Storage Type' => [
                    'Removable'
                ],
                'Recording Definition' => [
                    'High Definition'
                ],
                'Media Format' => [
                    'Flash Drive (SSD)'
                ],
                'Optical Zoom' => [
                    '10x'
                ]
            ],
            'brand' => 'GoPro',
            'mpn' => 'CHDHX-401',
            'imageUrls' => [
                'https://picsum.photos/200',
                'https://picsum.photos/300'
            ]
        ]
    ]);


Product Compatibility
`````````````````````

.. code-block:: php
    
    $sku = 'G********1';
    $client->inventory->productCompatibility($sku, [
        'compatibleProducts' => [
            [
                'productFamilyProperties' => [
                    'make' => 'Subaru',
                    'model' => 'DL',
                    'year' => '1982',
                    'trim' => 'Base Wagon 4-Door',
                    'engine' => '1.8L 1781CC H4 GAS SOHC Naturally Aspirated'
                ],
                'notes' => 'Equivalent to AC Delco Alternator'
            ],
            [
                'productFamilyProperties' => [
                    'make' => 'Subaru',
                    'model' => 'GL',
                    'year' => '1983',
                    'trim' => 'Base Wagon 4-Door',
                    'engine' => '1.8L 1781CC H4 GAS OHV Turbocharged'
                ],
                'notes' => 'Equivalent to AC Delco Alternator'
            ],
            [
                'productFamilyProperties' => [
                    'make' => 'Subaru',
                    'model' => 'DL',
                    'year' => '1985',
                    'trim' => 'Base Wagon 4-Door',
                    'engine' => '1.8L 1781CC H4 GAS SOHC Naturally Aspirated'
                ],
                'notes' => 'Equivalent to AC Delco Alternator'
            ],
            [
                'productFamilyProperties' => [
                    'make' => 'Subaru',
                    'model' => 'GL',
                    'year' => '1986',
                    'trim' => 'Base Wagon 4-Door',
                    'engine' => '1.8L 1781CC H4 GAS OHV Naturally Aspirated'
                ],
                'notes' => 'Equivalent to AC Delco Alternator'
            ]
        ]
    ]);


`Back to top <#top>`_