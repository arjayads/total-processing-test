<?php


return [
    'currency' => env('TOTAL_PROCESSING_CURRENCY', 'USD'),
    'users_table' => env('TOTAL_PROCESSING_USERS_TABLE', 'users'),
    'live' => env('TOTAL_PROCESSING_LIVE', false),
    'userId' => env('TOTAL_PROCESSING_USERID'),
    'password' => env('TOTAL_PROCESSING_PASSWORD'),
    'entityId' => env('TOTAL_PROCESSING_ENTITYID'),
];