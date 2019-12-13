<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Response;
use Image;

// Requests
use App\Http\Requests\Assets\IconRequest;
use App\Http\Requests\Assets\TeamRequest;

class AssetController extends Controller
{
    public function __construct()
    {
        $this->cached_assets_timeout = config('cache.cached_assets_timeout');
    }

    // The main logo
    public function logo()
    {
        $make = config('media.path') . config('logo.name');
        $img = Image::make($make);

        return $this->cachedAssetResponse($img, $make);
    }

    public function icon(IconRequest $request, $identifier)
    {
        $make = config('media.path') . config('icon.sub_dir') . $identifier . config('icon.file_ext');
        $img = Image::make($make);

        return $this->cachedAssetResponse($img, $make);
    }

    public function team(TeamRequest $request, $name)
    {
        $make = config('media.path') . config('team.sub_dir') . $name . config('team.file_ext');
        $img = Image::make($make);

        return $this->cachedAssetResponse($img, $make);
    }

    public function about()
    {
        $make = config('media.path') . config('media.about_image');
        $img = Image::make($make)->fit(600, 600);

        return $this->cachedAssetResponse($img, $make);
    }

    public function how()
    {
        $make = config('media.path') . config('media.how_image');
        $img = Image::make($make)->fit(600, 600);

        return $this->cachedAssetResponse($img, $make);
    }

    public function why()
    {
        $make = config('media.path') . config('media.why_image');
        $img = Image::make($make)->fit(600, 600);

        return $this->cachedAssetResponse($img, $make);
    }

    private function cachedAssetResponse($img, $make)
    {
        $response = Response::make($img->encode());
        $response->header('Content-Type', 'image');

        if(isset($make))
        {
            $time = Carbon::createFromTimestamp(filemtime($make))->format('D, d M Y H:i:s GMT');

            $response->header('Last-Modified', $time);
        }

        $response->header('Cache-Control', 'public, max-age=' . $this->cached_assets_timeout);

        return $response;
    }
}
