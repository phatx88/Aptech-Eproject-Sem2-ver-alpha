<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;

class Admin_OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Order $order)
    {
        if (!Gate::allows("view-order")) {
            abort(403);
        }
        $orderItem = Order::find($order->id)->orderItem; //hasMany result Array 
        $products = Product::get();
        return view('admin.order.add_item' , [
            'order' => $order,
            'products' => $products,
            'orderItem' => $orderItem,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Order $order)
    {
      //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Order $order)
    {
        if (!Gate::allows("create-order")) {
            abort(403);
        }
        $request->validate([
            'product_id' => 'required|max:255',
        ]);
        $unit_price = Product::find($request->product_id)->sale_price;
        $orderItem = new OrderItem();
        $orderItem->order_id = $request->order_id;
        $orderItem->product_id = $request->product_id;
        $orderItem->unit_price = $unit_price;
        $orderItem->qty = 1;
        $orderItem->total_price = $unit_price;
        try {
            $orderItem->save();
        } catch (QueryException $e) {
            request()->session()->put('error', $e->getMessage());
            return redirect()->back();
        }
        return redirect()->route('admin.order.item.index' , ['order' => $order]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
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
    public function update(Request $request, $order, $item)
    {
        if (!Gate::allows("update-order")) {
            abort(403);
        }
        $orderItem = OrderItem::where('order_id' , $order)->where('product_id' , $item)->first();
        $unit_price = $request->unit_price;
        $orderItem->unit_price = $unit_price;
        $orderItem->qty = $request->qty;
        $orderItem->total_price = $unit_price * $request->qty;
        try {
            $orderItem->save();
        } catch (QueryException $e) {
            request()->session()->put('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($order, $item)
    {
        if (!Gate::allows("delete-order")) {
            abort(403);
        }
        $orderItem = OrderItem::where('order_id' , $order)->where('product_id' , $item)->first();
        try {
            $orderItem->forceDelete();
            request()->session()->put('success', "Deleted Order_id: {$order} / Product_id: {$item} Successfully");
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                request()->session()->put('error', $e->getMessage());
            }
        }
        return redirect()->back();
    }
}
