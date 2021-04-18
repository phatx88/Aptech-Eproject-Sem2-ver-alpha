<?php

namespace App\Http\Controllers;


use App\Models\Province;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class User_CheckOutController extends Controller
{
    public function index() {
        $province = Province::orderby('id', 'ASC')->get();
        
        if (Auth::check()) {
            $user = Auth::user();
            return view('pages.checkout' , ['user' => $user])->with(compact('province'));
        }
        
        return view('pages.checkout')->with(compact('province'));
    }
}
