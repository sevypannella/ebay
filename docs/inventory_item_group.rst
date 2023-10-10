.. _top:
.. title:: Inventory Item Group

`Back to index <index.rst>`_

====================
Inventory Item Group
====================

.. contents::
    :local:


Create Or Replace Inventory Item Group
``````````````````````````````````````

.. code-block:: php
    
    $inventoryItemGroupKey = 'Mens_********_Shirts';
    $client->inventoryItemGroup->createOrReplace($inventoryItemGroupKey, [
        'aspects' => [
            'pattern' => [
                'solid'
            ],
            'sleeves' => [
                'short'
            ]
        ],
        'title' => 'Men\'s Solid Polo Shirts',
        'description' => 'Men\'s solid polo shirts in five colors (Green, Blue, Red, Black, and White), and sizes ranges from small to XL.',
        'imageUrls' => [
            'https://i*****g.com/0**********/**********1.jpg'
        ],
        'variantSKUs' => [
            'G********1'
        ],
        'variesBy' => [
            'aspectsImageVariesBy' => [
                'Color'
            ],
            'specifications' => [
                [
                    'name' => 'Color',
                    'values' => [
                        'Green',
                        'Blue',
                        'Red',
                        'Black',
                        'White'
                    ]
                ],
                [
                    'name' => 'Size',
                    'values' => [
                        'Small',
                        'Medium',
                        'Large',
                        'Extra-Large'
                    ]
                ]
            ]
        ]
    ]);


Get Inventory Item Group
````````````````````````

.. code-block:: php
    
    $inventoryItemGroupKey = 'Mens_********_Shirts';
    $result = $client->inventoryItemGroup->get($inventoryItemGroupKey);


Delete Inventory Item Group
```````````````````````````

.. code-block:: php
    
    $inventoryItemGroupKey = 'Mens_********_Shirts';
    $client->inventoryItemGroup->delete($inventoryItemGroupKey);


`Back to top <#top>`_
