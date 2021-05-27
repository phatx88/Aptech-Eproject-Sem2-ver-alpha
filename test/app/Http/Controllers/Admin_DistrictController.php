<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Province;

class Admin_DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $shippings = District::get();
        return view('admin.shipping.district.list_district',[
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
        // $shippings = District::get();
        // $provinces = Province::get();
        // return view('admin.shipping.district.add' , [
        //     'provinces' => $provinces,
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
        $shippings = District::get();
        $provinces = Province::get();
        return view('admin.shipping.district.add' , [
            'provinces' => $provinces,
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
    public function edit(District $district)
    {
        $shippings = District::get();
        return view('admin.shipping.district.edit' , [
            'shippings' => $shippings,
            'district' => $district

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, District $district)
    {
        $district->name = $request->name;
        $district->save();
        return redirect()->route("admin.district.index")->with('success', "Updated Transport Fee for Province Id - {$district->id} Successfully");

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
