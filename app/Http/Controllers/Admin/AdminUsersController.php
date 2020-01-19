<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Requests
use App\Http\Requests\Admin\Users\IndexRequest;

class AdminUsersController extends Controller
{
    public function index(IndexRequest $request)
    {
        return view('admin.users')->with([
            'stylesheet' => 'admin',
            'user' => \Auth::guard('admin')->user(),
        ]);
    }
}
