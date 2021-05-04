<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\Order;
use App\Models\ShippingStatus;
use Illuminate\Support\Facades\DB;

class FetchChartDataController extends Controller
{
    public function fetchOrderByProvince()
    {
        $data = DB::table('total_order_by_regions')->select('type', 'order_count', 'total_sales')->get();
        //fix vietnamese to json issues
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    public function fetchSalesPerProduct()
    {
        $data = DB::table('top_seller_product')->select('product_id', 'price', 'inventory', 'total_qty', 'total_sales')->get();
        //fix vietnamese to json issues
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    public function fetchOrder(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'created_date',
            2 => 'order_status_id',
            3 => 'customer_name',
            4 => 'shipping_fullname',
            5 => 'shipping_email',
            6 => 'shipping_mobile',
            7 => 'shipping_address',
            8 => 'shipping_fee',
            9 => 'coupon_discount',
            10 => 'amount',
            11 => 'total',
            12 => 'delivered_date',
            13 => 'payment_method'
        );

        $totalData = Order::count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $orders = Order::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $request->input('search.value');

            $orders =  Order::where('id', 'LIKE', "%{$search}%")
                ->orWhere('title', 'LIKE', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = Order::where('id', 'LIKE', "%{$search}%")
                ->orWhere('title', 'LIKE', "%{$search}%")
                ->count();
        }

        $data = array();
        if (!empty($orders)) {
            foreach ($orders as $order) {
                $show =  route('admin.order.show', $order->id);
                $edit =  route('admin.order.edit', $order->id);

                $nestedData['id'] = $order->id;
                $nestedData['created_date'] = $order->created_date;
                $nestedData['order_status_id'] = $order->getShippingStatus();
                $nestedData['delivered_date'] = $order->delivered_date ?? "";
                $nestedData['customer_name'] = $order->user->name ?? "guest";
                $nestedData['shipping_fullname'] = $order->shipping_fullname;
                $nestedData['shipping_email'] = $order->shipping_email;
                $nestedData['shipping_mobile'] = $order->shipping_mobile;
                $nestedData['shipping_address'] = $order->shipping_housenumber_street." , ".$order->ward->name." , ".$order->ward->district->name." , ".$order->ward->district->province->name;
                $nestedData['shipping_fee'] = "$".$order->shipping_fee ;
                $nestedData['coupon_discount'] = "$".($order->coupon->number ?? 0);
                $nestedData['amount'] = "$".($order->orderItem->sum('total_price'));
                $nestedData['total'] = "$".($order->orderItem->sum('total_price') - ($order->coupon->number ?? 0) + $order->shipping_fee);
                $nestedData['payment_method'] = $order->getPayment();
                $nestedData['option_show'] = "<a href='{$show}' title='SHOW' class='btn btn-primary btn-sm'>Show</a>";
                $nestedData['option_edit'] = "<a href='{$edit}' title='EDIT' class='btn btn-warning btn-sm'>Edit</a>";
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);
    }
}
