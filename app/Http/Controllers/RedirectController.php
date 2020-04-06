<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\Socials\Socials;

class RedirectController extends Controller
{
    public function spotify()
    {
        $social = Socials::find(6);
        
        return redirect($social->buildUrl(config("social.$social->id")));
    }
}
