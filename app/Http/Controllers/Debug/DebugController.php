<?php

namespace App\Http\Controllers\Debug;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DebugController extends Controller
{

    public function __construct()
    {
        $this->middleware('notprod');
    }

    public function phpInfo()
    {
        return phpinfo();
    }

    public function test()
    {
        // For test code to debug
    }
}
