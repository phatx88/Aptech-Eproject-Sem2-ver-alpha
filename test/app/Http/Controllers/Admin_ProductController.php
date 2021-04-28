<?php

namespace App\Http\Controllers;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Products;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Carbon\Carbon;
use Session;

// session_start();

class Admin_ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::orderby('id', 'DESC')->get();
        $product_view_count = DB::table('product')->orderby('view_count', 'DESC')->limit(5)->get();
        $name_product = array();
        $count_product = array();
        foreach($product_view_count as $key => $pro_count){
            $name_product[] = $pro_count->name;
            $count_product[] = $pro_count->view_count;
        }
        // //Count order-item
        // $order_count_product = session()->get('top_product');

        // $product_order_count = OrderItem::all();

        // $product_order_count_first = OrderItem::first();

        // if($order_count_product == null){

        //         $order_count_product[] = array(
        //             'id' => $product_order_count_first->product_id,
        //             'product_name' => $product_order_count_first->product->name,
        //             'product_count' => $product_order_count_first->qty
        //         );

        // }
        // $count = 0;
        // foreach($order_count_product as $key => $value){
        //     foreach ($product_order_count as  $pro_order){
        //         if($pro_order->product_id == $value['id']){
        //             $order_count_product[$key]['product_count'] += $pro_order->qty;
        //         }else{
        //             $order_count_product[] = array(
        //                 'id' => $pro_order->product_id,
        //                 'product_name' => $pro_order->product->name,
        //                 'product_count' => $pro_order->qty
        //             );
        //         }
        //     }
        // }
        // dd($order_count_product);
        // for($i = 0 ; $i < count($order_count_product) - 1; $i++){
        //     for($j = $i + 1; $j < count($order_count_product) ; $j++){
        //         if($order_count_product[$i]['product_count'] < $order_count_product[$j]['product_count']){
        //             $order_count_product[$i] = $order_count_product[$j];
        //         }
        //     }
        // }
        // $top5_seller = array();
        // for($k = 0 ; $k < 5; $k++){
        //     $top5_seller[] = $order_count_product[$k];
        // }
        // dd($top5_seller);

        // $order_name = array();
        // $order_count = array();
        // for($i = 0; $i <= 5; $i++){
        //     $order_name[] = $order_count[$i]['product_name'];
        //     $order_count[] = $order_count[$i]['product_count'];
        // }

        $top_product = DB::table('top_seller_product')
        ->orderby('total_qty', 'DESC')
        ->limit(5)->get();

        $order_name = array();
        $order_count = array();
        foreach ($top_product as $key => $value){
            $order_name[] = $value->name;
            $order_count[] = $value->total_qty;
        }
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $productChart  = (new LarapexChart)->polarAreaChart()
        ->setTitle('Top 5 View of Product in Now.')
        ->setSubtitle('Hiện tại : '. now())
        ->addData($count_product)
        ->setLabels($name_product);

        $orderChart  = (new LarapexChart)->polarAreaChart()
        ->setTitle('Top 5 Selling Product in Now.')
        ->setSubtitle('Hiện tại : '. now())
        ->addData($order_count)
        ->setLabels($order_name);



        return view('admin.product.list', [
            'products' => $products,
            'productChart' => $productChart,
            'orderChart' => $orderChart
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderby('name', 'ASC')->get();
        $brands = Brand::orderby('name', 'ASC')->get();
        return view('admin.product.add', [
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'featured_image' => 'bail|image|mimes:jpeg,png,jpg,gif,svg|unique:product|max:2048',
            'product_name' => 'bail|required|max:255',
            'price' => 'bail|numeric|required',
            'discount_percentage' => 'bail|numeric|required',
            'discount_from_date' => 'bail|date|required',
            'discount_to_date' => 'bail|date|required',
            'inventory_qty' => 'bail|numeric|required',
            'category_id' => 'bail|integer|required',
            'brand_id' => 'bail|integer|required',
            'featured' => 'bail|integer',
        ]);

        if ($request->hasFile('featured_image')) {
            $file = $request->file('featured_image');
            $imageName = $file->getClientOriginalName();

            //move file to folder
            $file->move(public_path('frontend\images\products'), $imageName);
        } else {
            $imageName = 'product-image-placeholder.jpg';
        }
        $product = new Products();
        $product->barcode = $request->barcode ?? null;
        $product->sku = $request->sku ?? null;
        $product->name = $request->product_name;
        $product->price = $request->price;
        $product->discount_percentage = $request->discount_percentage ?? 0;
        $product->discount_from_date = $request->discount_from_date ?? '2020-01-01';
        $product->discount_to_date = $request->discount_to_date ?? '2020-01-01';
        $product->featured_image = $imageName;
        $product->inventory_qty = $request->inventory_qty;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->created_date = $request->discount_created_date ?? Carbon::now();
        $product->description = $request->description;
        $product->featured = $request->featured;
        $product->save();
        return redirect()->route("admin.product.index")->with('success', "Added Product : {$product->name} / ID : {$product->id} Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Products $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $product)
    {
        $categories = Category::orderby('name', 'ASC')->get();
        $brands = Brand::orderby('name', 'ASC')->get();
        return view('admin.product.edit', [
            'categories' => $categories,
            'brands' => $brands,
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Products $product)
    {
        $request->validate([
            'featured_image' => 'bail|image|mimes:jpeg,png,jpg,gif,svg|unique:product|max:2048',
            'product_name' => 'bail|required|max:255',
            'price' => 'bail|numeric|required',
            'discount_percentage' => 'bail|numeric|required',
            'discount_from_date' => 'bail|date|required',
            'discount_to_date' => 'bail|date|required',
            'inventory_qty' => 'bail|numeric|required',
            'category_id' => 'bail|integer|required',
            'brand_id' => 'bail|integer|required',
            'featured' => 'bail|integer',
        ]);

        if ($request->hasFile('featured_image')) {
            $file = $request->file('featured_image');
            $imageName = $file->getClientOriginalName();

            //move file to folder
            $file->move(public_path('frontend\images\products'), $imageName);

            //delete old pic
            if ($product->featured_image != 'product-image-placeholder.jpg') {
                $oldFile = public_path('frontend\images\products\\' . $product->featured_image);
                File::delete($oldFile);
            }
        } else {
            $imageName = 'product-image-placeholder.jpg';
        }
        $product->barcode = $request->barcode ?? null;
        $product->sku = $request->sku ?? null;
        $product->name = $request->product_name;
        $product->price = $request->price;
        $product->discount_percentage = $request->discount_percentage ?? 0;
        $product->discount_from_date = $request->discount_from_date ?? '2020-01-01';
        $product->discount_to_date = $request->discount_to_date ?? '2020-01-01';
        $product->featured_image = $imageName;
        $product->inventory_qty = $request->inventory_qty;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->created_date = $request->discount_created_date ?? Carbon::now();
        $product->description = $request->description;
        $product->featured = $request->featured;
        $product->save();
        return redirect()->route("admin.product.index")->with('success', "Edited Product : {$product->name} / ID : {$product->id} Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Products $product)
    {
        try {
            $product->forceDelete();
            request()->session()->put('success', "Deleted Product : {$product->name} / ID : {$product->id} Successfully");
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                request()->session()->put('error', $e->getMessage());
            }
        }
        return redirect()->route("admin.product.index");
    }

    public function fetchProduct(Request $request)
    {
        $product_id = $request->product_id;
        $product = Product::find($product_id);
        echo json_encode($product);
    }

          
}
