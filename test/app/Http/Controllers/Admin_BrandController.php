<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;


class Admin_BrandController extends Controller
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
        $brands = Brand::get();
        return view('admin.brand.list',[
            'brands' => $brands
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brand.add');
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
            'name' => 'required|unique:brand|max:255',
        ]);

        $brand = new Brand();
        $brand->name = $request->name;
        $brand->save();
        return redirect()->action([Admin_BrandController::class,'index']);
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
    public function edit(Brand $brand)
    {
        return view('admin.brand.edit',[
            'brand' => $brand
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        if (!Gate::allows("update-product")) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|unique:brand|max:255',
        ]);

        $brand->name = $request->name;
        $brand->save();
        return redirect()->action([Admin_BrandController::class,'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        if (!Gate::allows("delete-product")) {
            abort(403);
        }

        try {
            $brand->forceDelete();
            request()->session()->put('success', "Deleted Category : {$brand->id} - {$brand->name} Successfully");
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                request()->session()->put('error', $e->getMessage());
            }
        }
        return redirect()->back();
    }
}
