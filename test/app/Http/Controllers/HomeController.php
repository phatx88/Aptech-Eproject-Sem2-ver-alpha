<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
       $products = DB::table('view_product')->get();
        // dd($products);
       return view('pages.home', ['products' => $products]);
    }

}
