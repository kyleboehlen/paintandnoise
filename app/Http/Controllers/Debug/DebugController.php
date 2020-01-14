<?php

namespace App\Http\Controllers\Debug;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DebugController extends Controller
{
    public function phpInfo()
    {
        if(config('app.env') != 'production')
        {
            return phpinfo();
        }

        return redirect()->route('root');
    }
}
