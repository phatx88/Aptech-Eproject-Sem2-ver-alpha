<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;  //Lay du lieu tu DB
use Illuminate\Http\Request;

class User_HomeController extends Controller
{    
    public function index(){
       $products = DB::table('view_product')
       ->join('brand', 'view_product.brand_id', '=', 'brand.id')
       ->join('category', 'view_product.category_id', '=', 'category.id')
       ->select('view_product.*', 'brand.name as brand_name','category.name as category_name')
       ->get();
       return view('pages.home', ['products' => $products]);
    }

}
