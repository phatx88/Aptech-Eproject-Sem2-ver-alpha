<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasswordSetupController extends Controller
{
        /*
    |--------------------------------------------------------------------------
    | Passwordset Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles password setups for new users
    |
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function passwordset($token)
    {
        return view('auth.passwords.passwordset')->with(['token' => $token]);
    }
}

