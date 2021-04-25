<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ShippingStatus;
use App\Models\Ward;
use App\Models\Staff;
use App\Models\User;
use App\Models\District;
use App\Models\Province;
use App\Models\Transport;
use Doctrine\DBAL\Schema\View;
use Illuminate\Database\QueryException;
use Carbon\Carbon;

class Admin_OrderController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $orders = Order::orderby('id' , 'DESC')->get();
        $orderItems = OrderItem::get();
        
        return view('admin.order.list', [
            'orders'=>$orders,
            'orderItems' => $orderItems,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::get();
        $provinces = Province::orderby('name', 'ASC')->get();
        $statuses = ShippingStatus::get();
        $staffs = User::where('is_staff' , '1')->get();
        $users = User::where('is_staff' , '0')->get();
        return view('admin.order.add', [
            'products' => $products,
            'statuses' => $statuses,
            'staffs' => $staffs,
            'users' => $users,
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
        $request->validate([
            'customer_id' => 'max:255',
            'order_status_id' => 'required',
            'shipping_fullname' => 'required|max:100',
            'shipping_mobile' => 'required',
            'shipping_email' => 'email:rfc,dns|max:255',
            'payment_method' => 'required',
            'shipping_ward_id' => 'required',
        ]);
        
        $order = new Order($request->all());
        $order->save();
        $request->session()->put('success' ,"Order ID: {$order->id} -- Created On : {$order->created_date} Added Successfully");
        return redirect()->route('admin.order.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $orderItem = Order::find($order->id)->orderItem; //hasMany result Array 
        $products = Product::get();
        $provinces = Province::orderby('name', 'ASC')->get();
        $statuses = ShippingStatus::get();
        $staffs = User::where('is_staff' , '1')->get();
        $users = User::where('is_staff' , '0')->get();
        return view('admin.order.detail' , [
            'order' => $order,
            'products' => $products,
            'orderItem' => $orderItem,
            'statuses' => $statuses,
            'staffs' => $staffs,
            'users' => $users,
            'provinces' => $provinces,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $orderItem = Order::find($order->id)->orderItem; //hasMany result Array 
        $products = Product::get();
        $provinces = Province::orderby('name', 'ASC')->get();
        $statuses = ShippingStatus::get();
        $staffs = Staff::get();
        $users = User::where('is_staff' , '0')->get();
        return view('admin.order.edit' , [
            'order' => $order,
            'products' => $products,
            'statuses' => $statuses,
            'orderItem' => $orderItem,
            'staffs' => $staffs,
            'users' => $users,
            'provinces' => $provinces,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'customer_id' => 'max:255',
            'order_status_id' => 'required',
            'shipping_fullname' => 'required|max:100',
            'shipping_mobile' => 'required',
            'shipping_email' => 'email|max:255',
            'payment_method' => 'required',
            'shipping_ward_id' => 'required',
            'delivered_date' => 'date'
        ]);
        $order->customer_id = $request->customer_id;
        $order->order_status_id = $request->order_status_id;
        $order->shipping_fullname = $request->shipping_fullname;
        $order->shipping_mobile = $request->shipping_mobile;
        $order->shipping_email = $request->shipping_email;
        $order->payment_method = $request->payment_method;
        $order->shipping_ward_id = $request->shipping_ward_id;
        $order->shipping_fee = $request->shipping_fee;
        $order->delivered_date = $request->delivered_date;
        $order->staff_id = $request->staff_id;
        $order->save();
        request()->session()->put('success' ,"Order ID: {$order->id} -- Created On : {$order->created_date} Updated Successfully");
        return redirect()->route('admin.order.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        try {
            $order->forceDelete();
            request()->session()->put('success', "Order ID : {$order->id} -- Created On : {$order->created_date} Deleted Successfully");
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                request()->session()->put('error', $e->getMessage());
            }
        }
        return redirect()->route("admin.order.index");
    }

    public function shipping_fee(Request $request){

        $transport = Transport::where('province_id', $request->province_id)->get();
        // $shipping = $transport->price;
        echo json_encode($transport);
    
    }
}
