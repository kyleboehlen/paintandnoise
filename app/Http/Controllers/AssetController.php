<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;

class AssetController extends Controller
{
    // The main logo
    public function logo()
    {
        return Image::make(config('envars.media_path') . config('envars.logo_name'))->response();
    }
}
