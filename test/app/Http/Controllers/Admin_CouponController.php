<?php

namespace App\Http\Controllers;

use App\Exports\CouponExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;

use Maatwebsite\Excel\Facades\Excel;
class Admin_CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Gate::allows("view-order")) {
            abort(403);
        }
        $coupons = Coupon::get();
        return view('admin.coupon.list',[
            'coupons' => $coupons
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::allows("create-order")) {
            abort(403);
        }
        return view('admin.coupon.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Gate::allows("create-order")) {
            abort(403);
        }
        $request->validate([
            'name' => 'required|unique:coupon|max:255',
        ]);
        $coupon = new Coupon();
        $coupon->name = $request->name;
        $coupon->code = $request->code;
        $coupon->time = $request->time;
        $coupon->cpn_condition = $request->cpn_condition;
        $coupon->number = $request->number;
        $coupon->save();
        return redirect()->route("admin.coupon.index")->with('success', "Added Coupon - {$coupon->id} Successfully");
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
    public function edit(Coupon $coupon)
    {
        if (!Gate::allows("update-order")) {
            abort(403);
        }
        return view('admin.coupon.edit',[
            'coupon' => $coupon
       ]) ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        if (!Gate::allows("update-order")) {
            abort(403);
        }
        $coupon->name = $request->name;
        $coupon->code = $request->code;
        $coupon->time = $request->time;
        $coupon->cpn_condition = $request->cpn_condition;
        $coupon->number = $request->number;
        $coupon->save();
        return redirect()->route("admin.coupon.index")->with('success', "Updated Coupon - ID : {$coupon->id} Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        if (!Gate::allows("delete-order")) {
            abort(403);
        }
        try {
            $msg = 'Deleted Product : '.$coupon->name.' - ID : '.$coupon->id.' Successfully';
            $coupon->delete();
            request()->session()->put('success', $msg);
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                request()->session()->put('error', $e->getMessage());
            }
        }
        return redirect()->route("admin.coupon.index");
    }

    public function export(){
        return Excel::download(new CouponExport, 'coupon.xlsx');
    }
}
