<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Carbon\Carbon;

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
        return view('admin.product.list', ['products' => $products]);
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
}
