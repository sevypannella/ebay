.. _top:
.. title:: Inventory Location

`Back to index <index.rst>`_

==================
Inventory Location
==================

.. contents::
    :local:


List Inventory Location
```````````````````````

.. code-block:: php
    
    $result = $client->inventoryLocation->list([
        'limit' => 10,
        'offset' => 0
    ]);


Get Inventory Location
``````````````````````

.. code-block:: php
    
    $merchantLocationKey = 's*****1';
    $result = $client->inventoryLocation->get($merchantLocationKey);


Create Inventory Location
`````````````````````````

.. code-block:: php
    
    $merchantLocationKey = 's*****1';
    $result = $client->inventoryLocation->create($merchantLocationKey, [
        'location' => [
            'address' => [
                'addressLine1' => '2********e',
                'addressLine2' => 'B********3',
                'city' => 'S*****e',
                'stateOrProvince' => '**',
                'postalCode' => '9***5',
                'country' => 'US'
            ]
        ],
        'locationInstructions' => 'Items ship from here.',
        'name' => 'W********1',
        'phone' => '2**-***-***4',
        'merchantLocationStatus' => 'ENABLED',
        'locationTypes' => [
            'WAREHOUSE'
        ]
    ]);


Update Inventory Location
`````````````````````````

.. code-block:: php
    
    $merchantLocationKey = 's*****1';
    $result = $client->inventoryLocation->update($merchantLocationKey, [
        'name' => 'W********h',
        'locationInstructions' => 'E****************g.',
        'locationAdditionalInformation' => 'Available for drop-off on Mondays only.',
        'locationWebUrl' => 'http://www.e*****e.com/w*****1',
        'phone' => '***-***-****'
    ]);


Enable Inventory Location
`````````````````````````

.. code-block:: php
    
    $merchantLocationKey = 'MERCH_LOC_42';
    $result = $client->inventoryLocation->enable($merchantLocationKey);


Disable Inventory Location
``````````````````````````

.. code-block:: php
    
    $merchantLocationKey = 'MERCH_LOC_42';
    $result = $client->inventoryLocation->disable($merchantLocationKey);


`Back to top <#top>`_