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
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;
use Carbon\Carbon;
use Session;


use App\Exports\ProductExport;
use Maatwebsite\Excel\Facades\Excel;
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
        if (!Gate::allows("view-product")) {
            abort(403);
        }
        $products = Products::orderby('id', 'DESC')->get();
        $product_view_count = DB::table('product')->orderby('view_count', 'DESC')->limit(5)->get();
        $name_product = array();
        $count_product = array();
        foreach($product_view_count as $key => $pro_count){
            $name_product[] = substr($pro_count->name, 0, 15)."...";
            $count_product[] = $pro_count->view_count;
        }

        $top_product = DB::table('top_seller_product')
        ->orderby('total_qty', 'DESC')
        ->limit(5)->get();

        $order_name = array();
        $order_count = array();
        foreach ($top_product as $key => $value){
            $order_name[] = substr($value->name,0,15)."...";
            $order_count[] = $value->total_qty;
        }
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $productChart  = (new LarapexChart)->pieChart()
        ->setTitle('Top 5 View of Product in Now.')
        ->setSubtitle(now())
        ->addData($count_product)
        ->setLabels($name_product);

        $orderChart  = (new LarapexChart)->polarAreaChart()
        ->setTitle('Top 5 Selling Product in Now.')
        ->setSubtitle(now())
        ->addData($order_count)
        ->setLabels($order_name);

        //HEAT MAP
        $product_id = DB::table('product')->orderBy('id' , 'asc')->pluck('id')->toArray();
        //item ordered
        $ordered_count = DB::table('order_item')
                        ->join('order', 'order_item.order_id' , '=' ,'order.id')
                        ->where('order.order_status_id' , '=' , 1)
                        ->selectRaw('order_item.product_id, sum(qty) as qty')
                        ->groupByRaw('order_item.product_id')
                        ->get();
        //MAPPING ITEM CANCEL TO HEAT MAP  
        foreach ($product_id as $value) {
            $flag = false;
            foreach ($ordered_count as $v) {
                if($value == $v->product_id) {
                    $ordered_qty[] = $v->qty;
                    $flag = true;
                }  
            }
            if (!$flag) {
                $ordered_qty[] = 0;
            }
        }

        //item Confirmed
        $confirmed_count = DB::table('order_item')
                        ->join('order', 'order_item.order_id' , '=' ,'order.id')
                        ->where('order.order_status_id' , '=' , 2)
                        ->selectRaw('order_item.product_id, sum(qty) as qty')
                        ->groupByRaw('order_item.product_id')
                        ->get();
        //MAPPING ITEM CANCEL TO HEAT MAP  
        foreach ($product_id as $value) {
            $flag = false;
            foreach ($confirmed_count as $v) {
                if($value == $v->product_id) {
                    $confirmed_qty[] = $v->qty;
                    $flag = true;
                }  
            }
            if (!$flag) {
                $confirmed_qty[] = 0;
            }
        }

        //item canceled
        $canceled_count = DB::table('order_item')
                        ->join('order', 'order_item.order_id' , '=' ,'order.id')
                        ->where('order.order_status_id' , '=' , 6)
                        ->selectRaw('order_item.product_id, sum(qty) as qty')
                        ->groupByRaw('order_item.product_id')
                        ->get();
        // dd($canceled_count);
        //MAPPING ITEM CANCEL TO HEAT MAP          
        foreach ($product_id as $value) {
            $flag = false;
            foreach ($canceled_count as $v) {
                if($value == $v->product_id) {
                    $canceled_qty[] = $v->qty;
                    $flag = true;
                }  
            }
            if (!$flag) {
                $canceled_qty[] = 0;
            }
        } 

        // dd($canceled_qty);
        $product_count = DB::table('product')->orderBy('id' , 'asc')->pluck('inventory_qty')->toArray();
        $inventoryChart = (new LarapexChart)->heatMapChart()
        ->setTitle('Product Statistics.')
        ->setSubtitle('As of : '. now())
        ->addHeat('On Hand', $product_count)
        ->addHeat('Ordered', $ordered_qty)
        ->addHeat('Confirmed', $confirmed_qty)
        ->addHeat('Canceled', $canceled_qty)
        ->setColors(['#4F46E5' , '#F111BB' , '#FFA41B' , '#D32F2F'])
        ->setXAxis($product_id);


        return view('admin.product.list', [
            'products' => $products,
            'productChart' => $productChart,
            'orderChart' => $orderChart,
            'inventoryChart' => $inventoryChart
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows("create-product")) {
            abort(403);
        }
        
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
        if (!Gate::allows("create-product")) {
            abort(403);
        }

        $request->validate([
            'featured_image' => 'bail|image|mimes:jpeg,png,jpg,gif,svg|unique:product|max:2048',
            'product_name' => 'bail|required|max:255',
            'price' => 'bail|numeric|required',
            'discount_percentage' => 'numeric|nullable',
            'discount_from_date' => 'date|nullable',
            'discount_to_date' => 'date|nullable',
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
     * @param  \App\Models\Products  $product
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
        if (!Gate::allows("update-product")) {
            abort(403);
        }

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
        if (!Gate::allows("update-product")) {
            abort(403);
        }
        $request->validate([
            'featured_image' => 'bail|image|mimes:jpeg,png,jpg,gif,svg|unique:product|max:2048',
            'product_name' => 'bail|required|max:255',
            'price' => 'bail|numeric|required',
            'discount_percentage' => 'numeric|nullable',
            'discount_from_date' => 'date|nullable',
            'discount_to_date' => 'date|nullable',
            'inventory_qty' => 'bail|numeric|required',
            'category_id' => 'bail|integer|required',
            'brand_id' => 'bail|integer|required',
            'featured' => 'bail|integer',
        ]);

        if (!empty($request->featured_image) && empty($product->featured_image)) {
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
            $product->featured_image = $imageName;
        }

        $product->barcode = $request->barcode ?? null;
        $product->sku = $request->sku ?? null;
        $product->name = $request->product_name;
        $product->price = $request->price;
        $product->discount_percentage = $request->discount_percentage ?? 0;
        $product->discount_from_date = $request->discount_from_date ?? '2020-01-01';
        $product->discount_to_date = $request->discount_to_date ?? '2020-01-01';
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
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Products $product)
    {
        // SOFT DELETE
        if (!Gate::allows("delete-product")) {
            abort(403);
        }
        try {
            $msg = 'Deleted Product : '.$product->name.' - ID : '.$product->id.' Successfully - <a href="'. url('admin/product/restore/'.$product->id.'') . '"> Undo Action</a>';
            $product->delete();
            request()->session()->put('success', $msg);
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                request()->session()->put('error', $e->getMessage());
            }
        }
        return redirect()->route("admin.product.index");
    }

    public function showTrash()
    {
        if (!Gate::allows("restore_product")) {
            abort(403);
        }
        $products = Products::onlyTrashed()->get();
        return view('admin.product.trash', [
            'products' => $products,
            ]);
    }

    public function restore($id)
    {
        if (!Gate::allows("restore_product")) {
            abort(403);
        }
        Products::onlyTrashed()->where('id' , $id)->restore();
        $product = Products::find($id);
        $msg = 'Restored Product : '.$product->name.' - ID : '.$product->id.' Successfully';
        request()->session()->put('success', $msg);
        return redirect()->back();
    }

    public function forceDelete($id)
    {
        // HARD DELETE
        if (!Gate::allows("force_delete_product")) {
            abort(403);
        }

        try {
            $product = Products::onlyTrashed()->find($id);
            $product->forceDelete();
            request()->session()->put('success', "Pernamently Deleted Product : {$product->name} / ID : {$product->id} From Record");
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                request()->session()->put('error', $e->getMessage());
            }
        }
        return redirect()->back();
    }

    public function fetchProduct(Request $request)
    {
        $product_id = $request->product_id;
        $product = Product::find($product_id);
        echo json_encode($product);
    }

    public function export(){
        return Excel::download(new ProductExport, 'productExport.xlsx');
    }

    public function status($id){
        $status = Products::where('id', $id)->value('hidden');
        if ($status == false) {
            Products::where('id', $id)->update([
                'hidden' => 1
            ]);
        } else {
            Products::where('id', $id)->update([
                'hidden' => 0
            ]);
        }
        return redirect()->back()->with('success', 'Product Status Changed');

    }


}
