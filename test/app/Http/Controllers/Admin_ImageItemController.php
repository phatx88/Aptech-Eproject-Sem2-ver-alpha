<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ImageItem;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;


class Admin_ImageItemController extends Controller
{
    
    public function index($id)
    {
        if (!Gate::allows("view-product")) {
            abort(403);
        }
        $ImageItems = ImageItem::where('product_id', $id)->get();
        return view('admin.image.list',[
            'ImageItems' => $ImageItems,
            'product_id' => $id
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //
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
            'image' =>'bail|image|required|mimes:jpg,jpeg,png|max:2048',
            'product_id'=>'bail|integer|required',
            ]);
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $name = $file->getClientOriginalName();
                $Image_Name = ImageItem::where('name', $name)->first();
                if($Image_Name){
                    request()->session()->put('error', 'Image is exist');
                }else{
                    $file->move(public_path('frontend\images\gallery'), $name);
                    $ImageItems = new ImageItem();
                    $ImageItems->product_id = $request->product_id;

                    $ImageItems->name = $name;
                    $ImageItems->save();
                    request()->session()->put('success', 'Image is exist');
                }
                session()->save();

            }
            return redirect('admin/ImageItem/' . $request->product_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($product_id, ImageItem $ImageItems)
    {
        if (!Gate::allows("update-product")) {
            abort(403);
        }
        return view('admin.image.edit',[
            'ImageItems' => $ImageItems,
            'product_id' => $product_id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product_id, ImageItem $ImageItems)
    {
        if (!Gate::allows("update-product")) {
            abort(403);
        }
        $request->validate([
            'image' =>'bail|image|required|mimes:jpg,jpeg,png|max:2048',
            'product_id'=>'bail|integer|required',
            ]);
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $name = $file->getClientOriginalName();

                //move file to folder
                $file->move(public_path('frontend\images\gallery'), $name);
            } else {
               $name =  'image.jpg';
            }

            $ImageItems->product_id = $product_id;
            $ImageItems->name = $name;
            $ImageItems->save();
            return redirect('admin/ImageItem/' . $request->product_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ImageItem $ImageItems)
    {
        if (!Gate::allows("delete-product")) {
            abort(403);
        }
        try{
            $msg = 'Delete ID:'. $ImageItems->product_id. '- product: ' .$ImageItems->name. 'successfully';
            $ImageItems->delete();
            request()->session()->put('success', $msg);
        }
        catch(QueryException $e) {
            if ($e->getCode() == 23000) {
                request()->session()->put('error', $e->getMessage());
            }
        }
        return redirect('admin/ImageItem/' . $request->product_id);
    }

    public function delete(Request $request,$id, $ImageItem_id){
        if (!Gate::allows("delete-product")) {
            abort(403);
        }
        try{
            $msg = 'Delete ID:'. $ImageItem_id. '- product successfully';
            ImageItem::where('id', $ImageItem_id)->where('product_id', $id)->delete();
            request()->session()->put('success', $msg);
        }catch(QueryException $e) {
            if ($e->getCode() == 23000) {
                request()->session()->put('error', $e->getMessage());
            }
        }
        return redirect()->back();
    }
}
