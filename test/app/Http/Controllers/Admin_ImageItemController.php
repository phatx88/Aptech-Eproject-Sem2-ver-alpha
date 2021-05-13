<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ImageItem;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;


class Admin_ImageItemController extends Controller
{

    public function index($id)
    {

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
            $ImageItems = new ImageItem();
            $ImageItems->product_id = $request->product_id;

            $ImageItems->name = $name;
            $ImageItems->save();
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ImageItem $ImageItems)
    {
        // try{
        //     $msg = 'Delete ID:'. $ImageItems->product_id. '- product: ' .$ImageItems->name. 'successfully';
        //     $ImageItems->delete();
        //     request()->session()->put('success', $msg);
        // }
        // catch(QueryException $e) {
        //     if ($e->getCode() == 23000) {
        //         request()->session()->put('error', $e->getMessage());
        //     }
        // }
        // return redirect('admin/ImageItem/' . $request->product_id);
    }
}
