<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;

class Admin_WardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (!Gate::any(['view_order', 'view_product'])) {
        //     abort(403);
        // }
        $shippings = Ward::get();
        return view('admin.shipping.ward.list_ward',[
            'shippings' => $shippings
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if (!Gate::any(['create_order', 'create_product'])) {
        //     abort(403);
        // }
        // $shippings = Ward::get();
        // $districts = District::get();
        // return view('admin.shipping.ward.add' , [
        //     'districts' => $districts,
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $shippings = Ward::get();
        $districts = District::get();
        return view('admin.shipping.district.add' , [
            'districts' => $districts,
        ]);
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
    public function edit(Ward $ward)
    {
        // if (!Gate::any(['update_order', 'update_product'])) {
        //     abort(403);
        // }
        $shippings = Ward::get();
        return view('admin.shipping.ward.edit' , [
            'shippings' => $shippings,
            'ward' => $ward

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ward $ward)
    {
        // if (!Gate::any(['update_order', 'update_product'])) {
        //     abort(403);
        // }

        $ward->name = $request->name;
        $ward->save();
        return redirect()->route("admin.ward.index")->with('success', "Updated Transport Fee for Province Id - {$ward->id} Successfully");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
