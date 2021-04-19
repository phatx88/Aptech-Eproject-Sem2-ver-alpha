<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon;
use Carbon\Carbon as CarbonCarbon;

class Admin_ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::orderby('id' , 'DESC')->get();
        return view('admin.product.list' , ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = DB::table('category')->get();
        return view('admin.product.add' , ['categories' => $categories]);
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
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        if($request->hasFile('image')){
            $file = $request->file('image');
            $imageName = $file->getClientOriginalName();
            
            //move file to folder
            $file->move(public_path('frontend\images\products'), $imageName);
        }
        else{
            $imageName = null;
        }
        $product= new Products();
        $product->barcode = $request->barcode ?? "";
        $product->sku = $request->sku ?? "";
        $product->name = $request->name;
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
        $product->hidden = $request->hidden;
        $product->save();
        return redirect()->action([Admin_ProductController::class,'index']);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Products $product)
    {
        //
    }
}
