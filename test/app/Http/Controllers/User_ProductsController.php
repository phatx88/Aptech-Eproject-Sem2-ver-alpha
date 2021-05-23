<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Carbon\Carbon;
use Validator;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Coupon;
use App\Models\User;
use App\Models\Comment;
use App\Models\ImageItem;

use Exception;

class User_ProductsController extends Controller
{
    public function index(Request $request, $slug= null)
    {
        $search = $request->input("search");
        $price_from = $request->price_from;
        $price_to = $request->price_to;

        $bestSelling = DB::table('top_seller_product')
        ->orderBy('total_qty' , 'DESC')
        ->limit(10)
        ->pluck('name')
        ->toArray();

        $bestSellingId = DB::table('top_seller_product')
        ->orderBy('total_qty' , 'DESC')
        ->limit(10)
        ->pluck('product_id')
        ->toArray();

        //SEARCH BY CATE_ID & FEATURED
        if ($slug != null) {
            switch ($slug) {
                case 'sale':
                    $products = DB::table('view_product')
                        ->join('brand', 'view_product.brand_id', '=', 'brand.id')
                        ->join('category', 'view_product.category_id', '=', 'category.id')
                        ->select('view_product.*', 'brand.name as brand_name', 'category.name as category_name')
                        ->whereColumn('price', '>', 'sale_price')
                        ->where('deleted_at', null)
                        ->where('hidden', false)
                        ->paginate(9);
                    break;

                case 'best':
                    $products = DB::table(function ($query) use ($bestSellingId) {
                        return $query
                            ->select('*')
                            ->from('view_product')
                            ->whereIn('id', $bestSellingId)
                            ->where('deleted_at', null)
                            ->where('hidden', false);
                    }, 'view_product')
                    ->join('brand', 'view_product.brand_id', '=', 'brand.id')
                    ->join('category', 'view_product.category_id', '=', 'category.id')
                    ->select('view_product.*', 'brand.name as brand_name', 'category.name as category_name')
                    ->paginate(9);
                    break;

                case 'new':
                    $products = DB::table('view_product')
                        ->join('brand', 'view_product.brand_id', '=', 'brand.id')
                        ->join('category', 'view_product.category_id', '=', 'category.id')
                        ->select('view_product.*', 'brand.name as brand_name', 'category.name as category_name')
                        ->where('created_date', '>', Carbon::now()->subDays(30))
                        ->where('deleted_at', null)
                        ->where('hidden', false)
                        ->paginate(9);
                    break;

                default:
                    $cate_id = null;
                    if ($slug) {
                        $tmp = explode('-' , $slug);
                        $cate_id = array_pop($tmp);
                        $conds[] = ["category_id", "=" , $cate_id];
                    }
                    $products = DB::table('view_product')
                        ->join('brand', 'view_product.brand_id', '=', 'brand.id')
                        ->join('category', 'view_product.category_id', '=', 'category.id')
                        ->select('view_product.*', 'brand.name as brand_name', 'category.name as category_name')
                        ->where($conds)
                        ->where('deleted_at', null)
                        ->where('hidden', false)
                        ->paginate(9);
                    break;
            }
        }

        // SEARCH by Price Range
        else if ($price_from != null && $price_to != null) {
            $products = DB::table('view_product')
                ->join('brand', 'view_product.brand_id', '=', 'brand.id')
                ->join('category', 'view_product.category_id', '=', 'category.id')
                ->select('view_product.*', 'brand.name as brand_name', 'category.name as category_name')
                ->WhereBetween('price', [$price_from, $price_to])
                ->where('deleted_at', null)
                ->where('hidden', false)
                ->paginate(9);
        }

        // SEARCH ALL OR BY NAME
        else if (!empty($select = $request->input("select"))) {
            list($column, $ordeBy) = explode( "-" ,$select); 
            
            $products = DB::table('view_product')
            ->join('brand', 'view_product.brand_id', '=', 'brand.id')
            ->join('category', 'view_product.category_id', '=', 'category.id')
            ->select('view_product.*', 'brand.name as brand_name', 'category.name as category_name')
            ->where('deleted_at', null)
            ->where('hidden', false)
            ->orderBy($column , $ordeBy)
            ->paginate(9);
                    
        }
        
        else {

            $products = DB::table(function ($query) {
                return $query
                    ->select('*')
                    ->from('view_product')
                    ->where('deleted_at', null)
                    ->where('hidden', false);
            }, 'view_product')
                ->join('brand', 'view_product.brand_id', '=', 'brand.id')
                ->join('category', 'view_product.category_id', '=', 'category.id')
                ->select('view_product.*', 'brand.name as brand_name', 'category.name as category_name')
                ->orwhere("brand.name", "LIKE", "%$search%")
                ->orWhere("category.name", "LIKE", "%$search%")
                ->orWhere("view_product.name", "LIKE", "%$search%")
                ->paginate(9)
                ;
        }

        //Get all category id
        $all_cate = DB::table('category')->get();
        $product_top_view = DB::table('product')->orderby('view_count', 'DESC')->limit(5)->get();
        return view('pages.product', [
            'products' => $products,
            'all_cate' => $all_cate,
            'search' => $search,
            'price_from' => $price_from,
            'price_to' => $price_to,
            'product_top_view' => $product_top_view,
            'bestSelling' => $bestSelling,
        ]);
    }

    public function find(Request $request)
    {
        $search = $request->input('query');
        $brands = Brand::select("name")
            ->Where("name", "LIKE", "%$search%")
            ->get();
        return response()->json($brands);
    }

    public function single_product($slug = null)
    {
        $id = null;
        if ($slug) {
            $tmp = explode('-' , $slug);
            $id = array_pop($tmp);
        }
        $comments = Comment::where('product_id', $id)->orderby('created_date', 'DESC')->paginate(5);
        $product = Product::where('id', $id)->get();
        $ImageItems = ImageItem::where('product_id', $id)->get();
        // dd($product);
        DB::table('product')->where('id', $id)->increment('view_count');
        $category_id = 0;
        foreach ($product as $key => $value) {
            $category_id = $value->category_id;
        }
        $related_product = Product::orderby('created_date', 'DESC')
            ->where('category_id', $category_id)
            ->where('deleted_at', null)
            ->where('hidden', false)
            ->get();

        $bestSelling = DB::table('top_seller_product')
        ->orderBy('total_qty' , 'DESC')
        ->limit(10)
        ->pluck('name')
        ->toArray();

        return view('pages.single_product')
            ->with('product', $product)
            ->with('related_product', $related_product)
            ->with('comments', $comments)
            ->with('bestSelling', $bestSelling)
            ->with('ImageItems', $ImageItems);
    }

    public function postComment(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'star' => 'required',
            'fullname' => 'required',
            'profile_pic' => 'nullable',
            'email' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
			return response()->json($validator->errors()->all() , 400);
        }
        else
        {
            try {
                // Save Comment to Data
            $comment = new Comment;
            $comment->product_id = $id;
            $comment->star = $request->star;
            $comment->email = $request->email;
            $comment->profile_pic = $request->profile_pic;
            $comment->fullname = $request->fullname;
            $comment->description = $request->description;
            $comment->save();

            } catch (Exception $e) {
                return response()->json([$e->getMessage()], 400);
            }
        }

        $comments = Comment::where('product_id', $id)->orderby('created_date', 'DESC')->paginate(5);
        $data = [];
        foreach ($comments as $comment) :
            $data[] = [
                'id' => $comment->id ,
                'fullname' => $comment->fullname,
                'email' => $comment->email,
                'profile_pic' => $comment->profile_pic,
                'star' => $comment->star,
                'description' => $comment->description,
                'created_date' => $comment->created_date
            ];
        endforeach;
        // dd ($data);
        echo json_encode($data);



    }
}
