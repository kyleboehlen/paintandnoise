<?php
return [
    'path' => storage_path() . env('MEDIA_STORAGE_PATH', '/app/public/media/'),
    'about_image' => env('ABOUT_IMAGE', 'about.jpg'),
    'about_attribution' => env('ABOUT_ATTRIBUTION', 'unsplash'),
    'how_image' => env('HOW_IMAGE', 'how.jpg'),
    'how_attribution' => env('HOW_ATTRIBUTION', 'unsplash'),
];