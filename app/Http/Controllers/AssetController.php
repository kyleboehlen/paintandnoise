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
        return Image::make(config('media.path') . config('logo.name'))->response();
    }

    public function icon(IconRequest $request, $identifier)
    {
        return Image::make(config('media.path') . config('icon.sub_dir') . $identifier . config('icon.file_ext'))->response();
    }
}
