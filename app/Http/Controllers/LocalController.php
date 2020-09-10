<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }

    public function index()
    {
        // Check if local is even enabled
        if(!config('local.enabled'))
        {
            return redirect()->route('home');
        }
        
        // Check if user zip is set
        // Get radius for zip code
        // Get posters within that zip radius
        // Get posts by users categories and posters ids
        
        return view('local')->with([
            // Posts sorted by closest
        ]);
    }
}
