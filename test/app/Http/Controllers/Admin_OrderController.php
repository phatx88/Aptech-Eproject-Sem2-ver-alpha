<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Coupon;
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
use App\Exports\OrderExport;
use Maatwebsite\Excel\Facades\Excel;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
// use Mail;
use Illuminate\Support\Facades\Mail;
use phpDocumentor\Reflection\Types\Nullable;

// use App\DataTables\OrderDataTable;

class Admin_OrderController extends Controller
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
        $orderTotals = DB::table('total_per_order')->get();
        $statuses = ShippingStatus::get();

        return view('admin.order.list', [
            'statuses' => $statuses,
            'orderTotals' => $orderTotals,
        ]);

        // return $dataTable->render('admin.order.list');
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
        $products = Product::get();
        $provinces = Province::orderby('name', 'ASC')->get();
        $statuses = ShippingStatus::get();
        $staffs = User::where('is_staff', '1')->get();
        $users = User::where('is_staff', '0')->get();
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
        if (!Gate::allows("create-order")) {
            abort(403);
        }
        $request->validate([
            'customer_id' => 'max:255',
            'order_status_id' => 'required',
            'shipping_fullname' => 'required|max:100',
            'shipping_mobile' => 'required',
            'shipping_email' => 'email:rfc,dns|max:255',
            'payment_method' => 'required',
            'shipping_ward_id' => 'required',
            'staff_id' => 'required'
        ]);

        $order = new Order($request->all());
        $order->save();
        $request->session()->put('success', "Order ID: {$order->id} -- Created On : {$order->created_date} Added Successfully");
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
        $staffs = User::where('is_staff', '1')->get();
        $users = User::where('is_staff', '0')->get();
        return view('admin.order.invoice', [
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
        if (!Gate::allows("update-order")) {
            abort(403);
        }
        $orderItem = Order::find($order->id)->orderItem; //hasMany result Array 
        $products = Product::with('order')->get();
        $coupons = Coupon::select('id' , 'code' , 'number')->get();
        $provinces = Province::orderby('name', 'ASC')->get();
        $statuses = ShippingStatus::where('id', '>=', $order->order_status_id)->get();
        $staffs = Staff::get();
        $users = User::with('ward', 'order')->where('is_staff', '0')->get();

        if ($order->order_status_id == '5' || $order->order_status_id == '6') {
            return view('admin.order.detail', [
                'order' => $order,
                'products' => $products,
                'orderItem' => $orderItem,
                'statuses' => $statuses,
                'staffs' => $staffs,
                'users' => $users,
                'provinces' => $provinces,
                'coupons' => $coupons,
            ]);
        } else {
            return view('admin.order.edit', [
                'order' => $order,
                'products' => $products,
                'orderItem' => $orderItem,
                'statuses' => $statuses,
                'staffs' => $staffs,
                'users' => $users,
                'provinces' => $provinces,
                'coupons' => $coupons,
            ]);
        }
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
        if (!Gate::allows("update-order")) {
            abort(403);
        }
        $request->validate([
            'customer_id' => 'max:255',
            'order_status_id' => 'required',
            'shipping_fullname' => 'required|max:100',
            'shipping_mobile' => 'required',
            'shipping_email' => 'email|max:255',
            'payment_method' => 'required',
            'coupon_id' => 'nullable',
            'shipping_ward_id' => 'required',
            'delivered_date' => 'date'
        ]);
        $order->customer_id = $request->customer_id;
        $order->order_status_id = $request->order_status_id;
        $order->shipping_fullname = $request->shipping_fullname;
        $order->shipping_mobile = $request->shipping_mobile;
        $order->shipping_email = $request->shipping_email;
        $order->payment_method = $request->payment_method;
        $order->coupon_id = $request->coupon_id;
        $order->shipping_ward_id = $request->shipping_ward_id;
        $order->shipping_fee = $request->shipping_fee;
        $order->delivered_date = $request->delivered_date;
        $order->staff_id = $request->staff_id;
        $order->save();
        request()->session()->put('success', "Order ID: {$order->id} -- Created On : {$order->created_date} Updated Successfully");

        //Send mail when confirm and deduce to inventory
        if ($order->order_status_id == 2) {
            foreach ($order->orderItem as $item) {
                if ($item->qty > $item->product->inventory_qty) {
                    request()->session()->put('error', "Not enough product {$item->product->name} on hand (Ordered: {$item->qty} vs IOH: {$item->product->inventory_qty})");
                    $order->order_status_id = 1;
                    $order->save();
                    return redirect()->back();
                }
            }

            foreach ($order->orderItem as $item) {
                DB::table('product')->where('id', $item->product_id)->decrement('inventory_qty', $item->qty);
            }

            $order_mail = Order::where('id', $order->id)->get();
            $order_details_mail = OrderItem::where('order_id', $order->id)->get();
            $details[] = [
                'user_name' => $request->shipping_fullname,
                'order_mail' => $order_mail,
                'order_details' => $order_details_mail
            ];

            Mail::to($request->shipping_email)->send(new \App\Mail\OrderConfirm($details));
            request()->session()->put('success', "Order ID: {$order->id} -- Created On : {$order->created_date} Has been Confirmed");
        }

        //return to inventory if order is cancelled
        if ($order->order_status_id == 6) {
            foreach ($order->orderItem as $item) {
                DB::table('product')->where('id', $item->product_id)->increment('inventory_qty', $item->qty);
            }
            request()->session()->put('error', "Order ID: {$order->id} -- Created On : {$order->created_date} Has been Cancelled");
        }

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
        if (!Gate::allows("delete-order")) {
            abort(403);
        }

        //SOFT DELETE
        try {
            $msg = 'Deleted Order ID : ' . $order->id . ' Successfully - <a href="' . url('admin/order/restore/' . $order->id . '') . '"> Undo Action</a>';
            $order->delete();
            request()->session()->put('success', $msg);
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                request()->session()->put('error', $e->getMessage());
            }
        }
        return redirect()->route("admin.order.index");
    }

    public function showTrash()
    {
        $orders = Order::onlyTrashed()->get();
        return view('admin.order.trash', [
            'orders' => $orders,
        ]);
    }

    public function restore($id)
    {
        if (!Gate::allows("restore-order")) {
            abort(403);
        }
        Order::onlyTrashed()->where('id', $id)->restore();
        $order = Order::find($id);
        $msg = 'Deleted Order ID : ' . $order->id . ' Successfully';
        request()->session()->put('success', $msg);
        return redirect()->back();
    }

    public function shipping_fee(Request $request)
    {

        $transport = Transport::where('province_id', $request->province_id)->get();
        // $shipping = $transport->price;
        echo json_encode($transport);
    }

    public function export()
    {
        return Excel::download(new OrderExport, 'orders.xlsx');
    }
}
