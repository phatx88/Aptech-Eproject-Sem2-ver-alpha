<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;  //Lay du lieu tu DB
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Post;
use App\Models\Newsletter;
class User_HomeController extends Controller
{
    public function index()
    {

        $products = DB::table('view_product')
                ->join('brand', 'view_product.brand_id', '=', 'brand.id')
                ->join('category', 'view_product.category_id', '=', 'category.id')
                ->select('view_product.*', 'brand.name as brand_name', 'category.name as category_name')
                ->where('deleted_at', null)
                ->where('hidden', false)
                ->orderBy('view_count' , 'ASC')
                ->limit(24)
                ->get();

        $bestSelling = DB::table('top_seller_product')
        ->orderBy('total_qty' , 'DESC')
        ->limit(10)
        ->pluck('name')
        ->toArray();

        $post = Post::orderBy('createdAt' , 'Desc')->limit(6)->get();
        // dd ($bestSelling);

        return view('pages.home', [
            'products' => $products,
            'bestSelling' => $bestSelling,
            'post' => $post
            ]);
    }

    public function subscribe_email(Request $request){
        $data = $request->all();
        $output = '';
        $email = Newsletter::where('email', $data['email'])->first();
        if($email){
            $output .= 'Email existed!!!';
        }else{
            $new_email = new Newsletter();
            $new_email->email = $data['email'];
            $new_email->save();
        }
        echo $output;
    }
}
