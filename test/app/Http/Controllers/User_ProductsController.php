<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class User_ProductsController extends Controller
{
    public function index($id = null){
        $all_cate = DB::table('category')->get();

        if(empty($id)){
            $products = DB::table('view_product')
            ->join('brand', 'view_product.brand_id', '=', 'brand.id')
            ->join('category', 'view_product.category_id', '=', 'category.id')
            ->select('view_product.*', 'brand.name as brand_name','category.name as category_name')
            ->paginate(9);
        }else{
            $products = DB::table('view_product')->where('category_id', $id)
            ->join('brand', 'view_product.brand_id', '=', 'brand.id')
            ->join('category', 'view_product.category_id', '=', 'category.id')
            ->select('view_product.*', 'brand.name as brand_name','category.name as category_name')
            ->paginate(9);
            // dd(DB::getQueryLog());
        }
        return view('pages.product', ['products' => $products, 'all_cate' => $all_cate]);
    }

    public function search_price(Request $request){
        $all_cate = DB::table('category')->get();

        $price_from = $request->price_from;
        $price_to = $request->price_to;

        $products = DB::table('view_product')
        ->whereBetween('price', [$price_from, $price_to])
        ->join('brand', 'view_product.brand_id', '=', 'brand.id')
        ->join('category', 'view_product.category_id', '=', 'category.id')
        ->select('view_product.*', 'brand.name as brand_name','category.name as category_name')
        ->paginate(9);
        return view('pages.product', ['products' => $products, 'all_cate' => $all_cate]);
    }

}
