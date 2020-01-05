<?php
return [
    'permissions_class' => \App\Http\Permissions\Admin::class,
    'super_admin' => [
        'email' => env('SUPER_ADMIN_EMAIL', 'admin@mail.paintandnoise.com'),
        'password'=> env('SUPER_ADMIN_PASSWORD', str_shuffle('LOTl9omoW5Pra4Cf')),
    ],
];