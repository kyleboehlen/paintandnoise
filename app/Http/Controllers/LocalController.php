<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Helpers
use App\Http\Helpers\Functions\ZipHelper;

// Models
use App\Models\Posts\Posts;

class LocalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }

    public function index()
    {
        $show = array();

        // Check if local is even enabled
        if(!config('local.enabled'))
        {
            return redirect()->route('home');
        }
        
        // Check if user zip is set
        $user = \Auth::user();
        if(is_null($user->zip_code))
        {
            array_push($show, 'zip_alert');
            return view('local')->with([
                'show' => $show,
            ]);
        }
        else
        {
            array_push($show, 'posts');
        }
        
        // Get top local posts
        $zips = ZipHelper::search($user->zip_code);
        $posts = Posts::whereIn('categories_id', $user->categoriesIdsArray())->whereIn('zip_code', $zips)->orderBy('total_votes', 'desc')->get();
        
        return view('local')->with([
            'posts' => $posts,
            'show' => $show,
        ]);
    }
}
