<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class User_ProductsController extends Controller
{
    public function index(Request $request, $id = null){
        
        $search = $request->input("search");
        $cate_id = $id;
        $price_from = $request->price_from;
        $price_to = $request->price_to;
        
        // SEARCH BY CATE ID 
        if ($cate_id != null) {
            $products = DB::table('view_product')
            ->join('brand', 'view_product.brand_id', '=', 'brand.id')
            ->join('category', 'view_product.category_id', '=', 'category.id')
            ->select('view_product.*', 'brand.name as brand_name','category.name as category_name')
            ->where('category_id', $cate_id)
            ->paginate(9);
        }
        // SEARCH by Price Range 
        else if ($price_from != null && $price_to != null) {
            $products = DB::table('view_product')
            ->join('brand', 'view_product.brand_id', '=', 'brand.id')
            ->join('category', 'view_product.category_id', '=', 'category.id')
            ->select('view_product.*', 'brand.name as brand_name','category.name as category_name')
            ->WhereBetween('price', [$price_from, $price_to])
            ->paginate(9);
        } 

        // SEARCH ALL OR BY NAME 
        else {
            $products = DB::table('view_product')
            ->join('brand', 'view_product.brand_id', '=', 'brand.id')
            ->join('category', 'view_product.category_id', '=', 'category.id')
            ->select('view_product.*', 'brand.name as brand_name','category.name as category_name')
            ->where("brand.name", "LIKE", "%$search%")
            ->orWhere("category.name", "LIKE", "%$search%")
            ->orWhere("view_product.name", "LIKE", "%$search%")
            ->paginate(9);
        }  
        
        //Get all category id
        $all_cate = DB::table('category')->get();

        return view('pages.product', [
            'products' => $products, 
            'all_cate' => $all_cate,
            'search' => $search,
            'price_from' => $price_from,
            'price_to' => $price_to,
            ]);
    }

}
