<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        // Show auth link
        $show = ['auth_link', ];

        // Create and return faq page view
        return view('faq')->with(['show' => $show]);
    }
}
