<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;  //Lay du lieu tu DB
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
       $products = DB::table('view_product')
       ->join('brand', 'view_product.brand_id', '=', 'brand.id')
       ->select('view_product.*', 'brand.name as brand_name')
       ->get();
       return view('pages.home', ['products' => $products]);
    }

}
