<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;

class AssetController extends Controller
{
    public function tempLogo()
    {
        return Image::make(config('envars.media_path') . config('envars.white_logo_name'))->response();
    }
}
