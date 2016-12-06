<?php

return [

    /*
     * storage can be set either to session or cache
     */
    'storage' => 'session',

    /*
     * prefix that is added to the store identifier
     */
    'storage-prefix' => 'state',

    /*
     * defines the expires after time in seconds, only used for CacheStore
     */
    'expires-after' => 300,
];
