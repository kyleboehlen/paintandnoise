<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Models
use App\Models\Posts\Posts;

class HomeController extends Controller
{
    public function index()
    {
        // For root route redirect to home if logged in
        if(\Auth::check())
        {
            return redirect()->route('home');
        }

        // Otherwise return the about splash page, which will show sign up options if authenticated
        return redirect()->route('about');
    }

    public function home()
    {
        return redirect()->route('trending');
    }

    public function trending()
    {
        // Get posts filtered by users categories
        $user = \Auth::user();
        $posts = Posts::whereIn('categories_id', $user->categoriesIdsArray());

        // Check users NSFW settings
        if(!$user->show_nsfw)
        {
            $posts = $posts->where('nsfw', $user->show_nsfw);
        }

        // Create and return home view
        return view('trending')->with([
            'category_link' => false,
            'nav_highlight' => 'trending',
            'posts' => $posts->orderBy('trending_score', 'desc')->simplePaginate(config('posts.paginate')),
        ]);
    }

    public function about()
    {
        // Show auth link
        $show = ['auth_link', ];

        // Create and return about splash page view
        return view('about')->with(['show' => $show]);
    }
}
