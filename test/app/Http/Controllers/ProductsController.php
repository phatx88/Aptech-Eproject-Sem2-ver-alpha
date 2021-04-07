<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function index(){
        $products = DB::table('view_product')
        ->join('brand', 'view_product.brand_id', '=', 'brand.id')
        ->join('category', 'view_product.category_id', '=', 'category.id')
        ->select('view_product.*', 'brand.name as brand_name','category.name as category_name')
        ->paginate(9);
        return view('pages.product', ['products' => $products]);
     }
}
