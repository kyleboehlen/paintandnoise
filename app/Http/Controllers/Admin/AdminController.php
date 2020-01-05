<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // For root route redirect to admin home if logged in
        if(\Auth::guard('admin')->check())
        {
            return redirect()->route('admin.home');
        }

        // Otherwise return the admin login page
        return redirect()->route('admin.login');
    }

    public function home()
    {
        // Create and return home view
        return view('admin.home')->with([
            'stylesheet' => 'admin',
        ]);
    }
}
