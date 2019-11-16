<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;

// Requests
use App\Http\Requests\Assets\IconRequest;

class AssetController extends Controller
{
    // The main logo
    public function logo()
    {
        return Image::make(config('envars.media_path') . config('envars.logo_name'))->response();
    }

    public function icon(IconRequest $request, $identifier)
    {
        return Image::make(config('envars.media_path') . config('envars.icon_sub_dir') . $identifier . config('envars.icon_file_ext'))->response();
    }
}
