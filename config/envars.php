<?php
return [
    'media_path' => storage_path() . env('MEDIA_STORAGE_PATH', '/app/public/media/'),
    'logo_name' => env('LOGO_NAME', 'circle-logo.png'),
];