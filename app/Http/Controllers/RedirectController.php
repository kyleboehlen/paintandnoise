<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\Socials\Socials;

// Constant Helpers
use App\Http\Helpers\Constants\Socials as SocialIds;

class RedirectController extends Controller
{
    public function spotify()
    {
        $social = Socials::find(SocialIds::SPOTIFY);
        
        return redirect($social->buildUrl(config("social.$social->id")));
    }
}
