<?php

namespace App\Http\Controllers;

use App\Models\Transport;
use App\Models\Province;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;


class Admin_TransportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Gate::any(['view_order', 'view_product'])) {
            abort(403);
        }
        $transports = Transport::get();
        return view('admin.transport.list' , [
            'transports' => $transports,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Gate::any(['create_order', 'create_product'])) {
            abort(403);
        } 
        $provinces = Province::get();
        return view('admin.transport.add' , [
            'provinces' => $provinces,
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
        if (!Gate::any(['create_order', 'create_product'])) {
            abort(403);
        } 
        $request->validate([
            'province_id' => 'bail|unique:transport|required',
            'price' => 'bail|required|max:255',
        ]);

        $transport = new Transport();
        $transport->province_id = $request->province_id;
        $transport->price = $request->price;
        $transport->save();
        return redirect()->route("admin.transport.index")->with('success', "Added New Transport Fee for Province Id - {$transport->province_id} Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transport  $transport
     * @return \Illuminate\Http\Response
     */
    public function show(Transport $transport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transport  $transport
     * @return \Illuminate\Http\Response
     */
    public function edit(Transport $transport)
    {
        if (!Gate::any(['update_order', 'update_product'])) {
            abort(403);
        } 
        $provinces = Province::get();
        return view('admin.transport.edit' , [
            'transport' => $transport,
            'provinces' => $provinces
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transport  $transport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transport $transport)
    {
        if (!Gate::any(['update_order', 'update_product'])) {
            abort(403);
        }
        $request->validate([
            'price' => 'bail|required|max:255',
        ]);

        $transport->price = $request->price;
        $transport->save();
        return redirect()->route("admin.transport.index")->with('success', "Updated Transport Fee for Province Id - {$transport->province_id} Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transport  $transports
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transport $transport)
    {
        // SOFT DELETE
        if (!Gate::any(['delete_order', 'delete_product'])) {
            abort(403);
        } 
        try {
            $msg = 'Deleted Product : '.$transport->name.' - ID : '.$transport->id.' Successfully - <a href="'. url('admin/transport/restore/'.$transport->id.'') . '"> Undo Action</a>';
            $transport->delete();
            request()->session()->put('success', $msg);
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                request()->session()->put('error', $e->getMessage());
            }
        }
        return redirect()->route("admin.transport.index");
    }

    public function showTrash()
    {
        if (!Gate::any(['restore_order', 'restore_product'])) {
            abort(403);
        }  
        $transports = Transport::onlyTrashed()->get();
        return view('admin.transport.trash', [
            'transports' => $transports,
            ]);
    }

    public function restore($id)
    {
        if (!Gate::any(['restore_order', 'restore_product'])) {
            abort(403);
        } 
        Transport::onlyTrashed()->where('id' , $id)->restore();
        $transport = Transport::find($id);
        $msg = 'Restored Transport Fee : '.$transport->name.' - ID : '.$transport->id.' Successfully';
        request()->session()->put('success', $msg);
        return redirect()->back();
    }
}
