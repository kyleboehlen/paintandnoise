<?php
return [
    'media_path' => storage_path() . env('MEDIA_STORAGE_PATH', '/app/public/media/'),
    'icon_sub_dir' => env('ICON_SUB_DIR', 'icons/'),
    'icon_file_ext' => env('ICON_FILE_EXT', '.png'),
    'logo_name' => env('LOGO_NAME', 'circle-logo.png'),
];