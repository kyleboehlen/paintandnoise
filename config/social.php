<?php
use App\Http\Helpers\Constants\Socials;

return [
    Socials::FACEBOOK => [
        'username' => env('FACEBOOK_USERNAME', 'paintandnoise'),
    ],
    Socials::TWITTER => [
        'username' => env('TWITTER_USERNAME', 'paintandnoise'),
    ],
    Socials::INSTAGRAM => [
        'username' => env('INSTAGRAM_USERNAME', 'paintandnoise'),
    ],
    Socials::SPOTIFY => [
        'type' => env('SPOTIFY_TYPE', 'user'),
        'uid' => env('SPOTIFY_UID', '06hpbv4kf4wq8ncu95k61l41c?si=rWYCcURlQGGyxtZMnsEgrw'),
    ],
];