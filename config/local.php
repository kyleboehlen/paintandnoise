<?php
return [
    'enabled' => env('LOCAL_FEED_ENABLED', false),
    'radius' => env('LOCAL_ZIP_RADIUS', 100),
    'zip_wise' => [
        'api_key' => env('ZIP_WISE_API_KEY'),
    ],
];