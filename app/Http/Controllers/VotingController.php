<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VotingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
    }

    public function index()
    {
        return view('voting')->with([
            // IDK
        ]);
    }
}
