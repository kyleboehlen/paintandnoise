<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    protected function guard()
    {
        return \Auth::guard('admin');
    }

    protected function broker()
    {
        return Password::broker('admins');
    }

    /** 
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function showResetForm($token)
    {   
        return view('admin.reset')->with([
            'token' => $token,
        ]);
    }
}
