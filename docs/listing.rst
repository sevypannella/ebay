.. _top:
.. title:: Listing

`Back to index <index.rst>`_

=======
Listing
=======

.. contents::
    :local:


Bulk Migrate
````````````

.. code-block:: php
    
    $result = $client->listing->bulkMigrate([
        'requests' => [
            [
                'listingId' => '1**********1'
            ],
            [
                'listingId' => '1**********2'
            ],
            [
                'listingId' => '1**********3'
            ]
        ]
    ]);


`Back to top <#top>`_