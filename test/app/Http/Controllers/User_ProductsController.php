<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Carbon\Carbon;

class User_ProductsController extends Controller
{
    public function index(Request $request, $id = null){
        
        $search = $request->input("search");
        $price_from = $request->price_from;
        $price_to = $request->price_to;
        

        //SEARCH BY CATE_ID & FEATURED 
        if ($id != null){
            switch ($id) {
                case 'sale':
                    $products = DB::table('view_product')
                    ->join('brand', 'view_product.brand_id', '=', 'brand.id')
                    ->join('category', 'view_product.category_id', '=', 'category.id')
                    ->select('view_product.*', 'brand.name as brand_name','category.name as category_name')
                    ->whereColumn('price' , '>' , 'sale_price' )
                    ->where('hidden' , false)
                    ->paginate(9);
                    break;
                
                case 'best':
                    $products = DB::table('view_product')
                    ->join('brand', 'view_product.brand_id', '=', 'brand.id')
                    ->join('category', 'view_product.category_id', '=', 'category.id')
                    ->select('view_product.*', 'brand.name as brand_name','category.name as category_name')
                    ->where('featured' , 1 )
                    ->where('hidden' , false)
                    ->paginate(9);
                    break;

                case 'new':
                    $products = DB::table('view_product')
                    ->join('brand', 'view_product.brand_id', '=', 'brand.id')
                    ->join('category', 'view_product.category_id', '=', 'category.id')
                    ->select('view_product.*', 'brand.name as brand_name','category.name as category_name')
                    ->where('created_date' , '>' , Carbon::now()->subDays(30) )
                    ->where('hidden' , false)
                    ->paginate(9);
                    break;

                default:
                    $cate_id = $id;
                    $products = DB::table('view_product')
                    ->join('brand', 'view_product.brand_id', '=', 'brand.id')
                    ->join('category', 'view_product.category_id', '=', 'category.id')
                    ->select('view_product.*', 'brand.name as brand_name','category.name as category_name')
                    ->where('category_id', $cate_id)
                    ->where('hidden' , false)
                    ->paginate(9);
                    break;
            }
            
        }

        // SEARCH by Price Range 
        else if ($price_from != null && $price_to != null) {
            $products = DB::table('view_product')
            ->join('brand', 'view_product.brand_id', '=', 'brand.id')
            ->join('category', 'view_product.category_id', '=', 'category.id')
            ->select('view_product.*', 'brand.name as brand_name','category.name as category_name')
            ->WhereBetween('price', [$price_from, $price_to])
            ->where('hidden' , false)
            ->paginate(9);
        } 

        // SEARCH ALL OR BY NAME 
        else {

            $products = DB::table(function($query){
                return $query
                ->select('*')
                ->from('view_product')
                ->where('hidden' , false);                
            }, 'view_product')
                    ->join('brand', 'view_product.brand_id', '=', 'brand.id')
                   ->join('category', 'view_product.category_id', '=', 'category.id')
                   ->select('view_product.*', 'brand.name as brand_name','category.name as category_name')
                   ->orwhere("brand.name", "LIKE", "%$search%")
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
