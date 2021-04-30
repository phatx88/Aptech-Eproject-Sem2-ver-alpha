<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;  //Lay du lieu tu DB
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class User_HomeController extends Controller
{
    public function index()
    {

        $products = Cache::remember('homepage-products', now()->addHours(12), function () {         
            return DB::table('view_product')
                ->join('brand', 'view_product.brand_id', '=', 'brand.id')
                ->join('category', 'view_product.category_id', '=', 'category.id')
                ->select('view_product.*', 'brand.name as brand_name', 'category.name as category_name')
                ->get();
        });
        
        return view('pages.home', ['products' => $products]);
    }
}
