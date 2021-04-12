<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Admin_ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::get();
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
        if($request->hasFile('image')){
            //$data = $request->all();
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            // dd($extension);
            if($extension != 'jpg' && $extension != 'png' && $extension != 'jpeg'){
                return redirect('product.create')
                ->with('error','Only accept Image with extension jpg, png, jpeg');
            }
            $imageName = $file->getClientOriginalExtension();
            $file->move(public_path('frontend\images\products'), $imageName);
        }
        else{
            $imageName = null;
    }
        $product= new Products();
        $product->sku = '';
        $product->discount_percentage = 0;
        $product->discount_from_date = '2020-01-01';
        $product->discount_to_date = '2020-01-01';
        $product->created_date = '2020-02-02';
        $product->name = $request->name;
        $product->price = $request->price;
        $product->inventory_qty = $request->inventory_qty;
        $product->category_id = $request->category;
        $product->featured = $request->featured;
        $product->featured_image = $imageName;
        $product->description = $request->description;
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
     * @param  \App\Models\Product  $product
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
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Products $product)
    {
        //
    }
}
