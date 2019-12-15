<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        // Create and return home view
        return 'home';
    }

    public function about()
    {
        // Show auth link
        $show = ['auth_link', ];

        // Create and return about splash page view
        return view('about')->with(['show' => $show]);
    }
}
