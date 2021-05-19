<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Ward;
use App\Models\District;
use App\Models\Province;
class FetchChartDataController extends Controller
{

    //Fetch data for Charts
    public function fetchOrderByProvince()
    {
        $data = DB::table('total_order_by_regions')->select('type', 'order_count', 'total_sales')->get();
        //fix vietnamese to json issues
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    public function fetchDailyOrder()
    {
        $data = Order::where('created_date', '>=' , Carbon::now()->subYear(2))->selectRaw( 'created_date , count(id)')->groupByRaw('date(created_date)')->get();
        //fix vietnamese to json issues
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    public function fetchSalesPerProduct()
    {
        $data = DB::table('top_seller_product')->select('product_id', 'price', 'inventory', 'total_qty', 'total_sales')->get();
        //fix vietnamese to json issues
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    public function fetchValuePerUser()
    {
        $data = DB::table('total_per_user')->select('name','amount_spent')->orderBy('amount_spent' , 'desc')->get();
        //fix vietnamese to json issues
        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    //Fetchdata for Datatables

    public function fetchOrder(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'created_date',
            2 => 'order_status_id',
            3 => 'customer_id',
            4 => 'shipping_fullname',
            5 => 'shipping_email',
            6 => 'shipping_mobile',
            7 => 'shipping_housenumber_street',
            8 => 'shipping_fee',
            9 => 'coupon_id',
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


        //Search Individuall collumns
        $columns = $request->input('columns');
        for ($i=0; $i < $totalFiltered; $i++) {
            if( !empty($request->columns[$i]['search']['value']))
            {
                $whereColumns = $request->columns[$i]['data'];
                $search = $request->columns[$i]['search']['value'];
            }
        }
        //if no search value get all
        if (empty($search)) {
            if (empty($request->input('search.value'))) {
                $orders = Order::offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();
            } else {
                $search = $request->input('search.value');

                $orders =  Order::where('id', 'LIKE', "%{$search}%")
                    ->orWhere('shipping_fullname', 'LIKE', "%{$search}%")
                    ->orWhere('shipping_email', 'LIKE', "%{$search}%")
                    ->orWhere('shipping_mobile', 'LIKE', "%{$search}%")
                    ->orWhere('shipping_housenumber_street', 'LIKE', "%{$search}%")
                    ->orWhere('created_date', 'LIKE', "%{$search}%")
                    ->orWhere('delivered_date', 'LIKE', "%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();

                $totalFiltered = Order::where('id', 'LIKE', "%{$search}%")
                    ->orWhere('shipping_fullname', 'LIKE', "%{$search}%")
                    ->orWhere('shipping_email', 'LIKE', "%{$search}%")
                    ->orWhere('shipping_mobile', 'LIKE', "%{$search}%")
                    ->orWhere('shipping_housenumber_street', 'LIKE', "%{$search}%")
                    ->orWhere('created_date', 'LIKE', "%{$search}%")
                    ->orWhere('delivered_date', 'LIKE', "%{$search}%")
                    ->count();
            }
        } else {
            $orders = Order::where($whereColumns, '=' , $search)
                    ->orwhere($whereColumns,'LIKE',"%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();

            $totalFiltered = Order::where($whereColumns,'LIKE',"%{$search}%")->count();
        }

        $data = array();
        if (!empty($orders)) {
            foreach ($orders as $order) {
                $show =  route('admin.order.show', $order->id);
                $edit =  route('admin.order.edit', $order->id);
                $delete =  route('admin.order.destroy', $order->id);

                $nestedData['id'] = intval($order->id);
                $nestedData['created_date'] = date($order->created_date);
                $nestedData['order_status_id'] = $order->getShippingStatus();
                $nestedData['delivered_date'] = date($order->delivered_date ?? "");
                $nestedData['customer_id'] = $order->user->name ?? "guest";
                $nestedData['shipping_fullname'] = $order->shipping_fullname;
                $nestedData['shipping_email'] = $order->shipping_email;
                $nestedData['shipping_mobile'] = $order->shipping_mobile;
                $nestedData['shipping_housenumber_street'] = $order->shipping_housenumber_street." , ".$order->ward->name." , ".$order->ward->district->name." , ".$order->ward->district->province->name;
                $nestedData['shipping_fee'] = "$".number_format($order->shipping_fee) ;
                $nestedData['coupon_id'] = "$".number_format(($order->coupon->number ?? 0));
                $nestedData['amount'] = "$".number_format(($order->orderItem->sum('total_price')));
                $nestedData['total'] = "$".number_format(($order->orderItem->sum('total_price') - ($order->coupon->number ?? 0) + $order->shipping_fee));
                $nestedData['payment_method'] = $order->getPayment();
                $nestedData['option_show'] = "<a href='{$show}' title='INVOICE' class='btn btn-success btn-sm'><i class='fas fa-file-invoice'></i></a>";
                $nestedData['option_edit'] = $edit;
                $nestedData['option_delete'] = $delete;
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

    public function fetchWard(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'type',
            3 => 'district_id'
        );

        $totalData = Ward::count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');


        //Search Individuall collumns
        $columns = $request->input('columns');
        for ($i=0; $i < $totalFiltered; $i++) {
            if( !empty($request->columns[$i]['search']['value']))
            {
                $whereColumns = $request->columns[$i]['data'];
                $search = $request->columns[$i]['search']['value'];
            }
        }
        //if no search value get all
        if (empty($search)) {
            if (empty($request->input('search.value'))) {
                $orders = Ward::offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();
            } else {
                $search = $request->input('search.value');

                $orders =  Ward::where('id', 'LIKE', "%{$search}%")
                    ->orWhere('name', 'LIKE', "%{$search}%")
                    ->orWhere('type', 'LIKE', "%{$search}%")
                    ->orWhere('district_id', 'LIKE', "%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();

                $totalFiltered = Ward::where('id', 'LIKE', "%{$search}%")
                    ->orWhere('name', 'LIKE', "%{$search}%")
                    ->orWhere('type', 'LIKE', "%{$search}%")
                    ->orWhere('district_id', 'LIKE', "%{$search}%")
                    ->count();
            }
        } else {
            $orders = Ward::where($whereColumns, '=' , $search)
                    ->orwhere($whereColumns,'LIKE',"%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();

            $totalFiltered = Ward::where($whereColumns,'LIKE',"%{$search}%")->count();
        }

        $data = array();
        if (!empty($orders)) {
            foreach ($orders as $order) {
                $show =  route('admin.ward.show', $order->id);
                $edit =  route('admin.ward.edit', $order->id);
                $delete =  route('admin.ward.destroy', $order->id);

                $nestedData['id'] = intval($order->id);
                $nestedData['name'] = $order->name;
                $nestedData['type'] = $order->type;
                $nestedData['district_id'] = intval($order->district_id);


                $nestedData['option_show'] = "<a href='{$show}' title='SHOW' class='btn btn-primary btn-sm'>Show</a>";
                $nestedData['option_edit'] = "<a href='{$edit}' title='EDIT' class='btn btn-warning btn-sm'>Edit</a>";
                $nestedData['option_delete'] = $delete;
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

    public function fetchDistrict(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'type',
            3 => 'province_id'
        );

        $totalData = District::count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');


        //Search Individuall collumns
        $columns = $request->input('columns');
        for ($i=0; $i < $totalFiltered; $i++) {
            if( !empty($request->columns[$i]['search']['value']))
            {
                $whereColumns = $request->columns[$i]['data'];
                $search = $request->columns[$i]['search']['value'];
            }
        }
        //if no search value get all
        if (empty($search)) {
            if (empty($request->input('search.value'))) {
                $orders = District::offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();
            } else {
                $search = $request->input('search.value');

                $orders =  District::where('id', 'LIKE', "%{$search}%")
                    ->orWhere('name', 'LIKE', "%{$search}%")
                    ->orWhere('type', 'LIKE', "%{$search}%")
                    ->orWhere('province_id', 'LIKE', "%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();

                $totalFiltered = District::where('id', 'LIKE', "%{$search}%")
                    ->orWhere('name', 'LIKE', "%{$search}%")
                    ->orWhere('type', 'LIKE', "%{$search}%")
                    ->orWhere('province_id', 'LIKE', "%{$search}%")
                    ->count();
            }
        } else {
            $orders = District::where($whereColumns, '=' , $search)
                    ->orwhere($whereColumns,'LIKE',"%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();

            $totalFiltered = District::where($whereColumns,'LIKE',"%{$search}%")->count();
        }

        $data = array();
        if (!empty($orders)) {
            foreach ($orders as $order) {
                $show =  route('admin.district.show', $order->id);
                $edit =  route('admin.district.edit', $order->id);
                $delete =  route('admin.district.destroy', $order->id);

                $nestedData['id'] = intval($order->id);
                $nestedData['name'] = $order->name;
                $nestedData['type'] = $order->type;
                $nestedData['province_id'] = intval($order->province_id);


                $nestedData['option_show'] = "<a href='{$show}' title='SHOW' class='btn btn-primary btn-sm'>Show</a>";
                $nestedData['option_edit'] = "<a href='{$edit}' title='EDIT' class='btn btn-warning btn-sm'>Edit</a>";
                $nestedData['option_delete'] = $delete;
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



    public function fetchProvince(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'type',
        );

        $totalData = Province::count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');


        //Search Individuall collumns
        $columns = $request->input('columns');
        for ($i=0; $i < $totalFiltered; $i++) {
            if( !empty($request->columns[$i]['search']['value']))
            {
                $whereColumns = $request->columns[$i]['data'];
                $search = $request->columns[$i]['search']['value'];
            }
        }
        //if no search value get all
        if (empty($search)) {
            if (empty($request->input('search.value'))) {
                $orders = Province::offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();
            } else {
                $search = $request->input('search.value');

                $orders =  Province::where('id', 'LIKE', "%{$search}%")
                    ->orWhere('name', 'LIKE', "%{$search}%")
                    ->orWhere('type', 'LIKE', "%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();

                $totalFiltered = Province::where('id', 'LIKE', "%{$search}%")
                    ->orWhere('name', 'LIKE', "%{$search}%")
                    ->orWhere('type', 'LIKE', "%{$search}%")
                    ->count();
            }
        } else {
            $orders = Province::where($whereColumns, '=' , $search)
                    ->orwhere($whereColumns,'LIKE',"%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();

            $totalFiltered = Province::where($whereColumns,'LIKE',"%{$search}%")->count();
        }

        $data = array();
        if (!empty($orders)) {
            foreach ($orders as $order) {
                $show =  route('admin.province.show', $order->id);
                $edit =  route('admin.province.edit', $order->id);
                $delete =  route('admin.province.destroy', $order->id);

                $nestedData['id'] = intval($order->id);
                $nestedData['name'] = $order->name;
                $nestedData['type'] = $order->type;


                $nestedData['option_show'] = "<a href='{$show}' title='SHOW' class='btn btn-primary btn-sm'>Show</a>";
                $nestedData['option_edit'] = "<a href='{$edit}' title='EDIT' class='btn btn-warning btn-sm'>Edit</a>";
                $nestedData['option_delete'] = $delete;
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



    public function fetchUser(Request $request)
    {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'email_verified_at',
            4 => 'created_at',
            5 => 'updated_at',
            6 => 'mobile',
            7 => 'profile_pic',
            8 => 'provider',
            9 => 'last_login_at',
            10 => 'total_ordered',
            11 => 'amount_spent'
        );

        $totalData = DB::table('total_per_user')->where('is_staff' , 0)->count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')]; //arrange from order of collumn 0
        $dir = $request->input('order.0.dir');

         //Search Individuall collumns
         $columns = $request->input('columns');
         for ($i=0; $i < $totalFiltered; $i++) {
             if( !empty($request->columns[$i]['search']['value']))
             {
                 $whereColumns = $request->columns[$i]['data'];
                 $search = $request->columns[$i]['search']['value'];
             }
        }
        if (empty($search)) {
        if (empty($request->input('search.value'))) {
            $users = DB::table('total_per_user')->where('is_staff' , 0)
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
            } else {
                $search = $request->input('search.value');

                $users = DB::table('total_per_user')->where('is_staff' , 0)
                    ->where('id', 'LIKE', "%{$search}%")
                    ->orWhere('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('mobile', 'LIKE', "%{$search}%")
                    ->orWhere('provider', 'LIKE', "%{$search}%")
                    ->orWhere('created_at', 'LIKE', "%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();

                $totalFiltered = DB::table('total_per_user')->where('is_staff' , 0)
                    ->where('id', 'LIKE', "%{$search}%")
                    ->orWhere('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('mobile', 'LIKE', "%{$search}%")
                    ->orWhere('provider', 'LIKE', "%{$search}%")
                    ->orWhere('created_at', 'LIKE', "%{$search}%")
                    ->count();
            }
        }  else {
            $users = DB::table('total_per_user')
                    ->where('is_staff' , 0)
                    ->where($whereColumns, '=' , $search)
                    ->orwhere($whereColumns,'LIKE',"%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($order, $dir)
                    ->get();

            $totalFiltered = DB::table('total_per_user')
                            ->where('is_staff' , 0)
                            ->where($whereColumns,'LIKE',"%{$search}%")->count();
        }

        $data = array();

        if (!empty($users)) {
            foreach ($users as $user) {
                $show =  route('admin.user.show', $user->id);
                $edit =  route('admin.user.edit', $user->id);
                $delete =  route('admin.user.destroy', $user->id);
                $nestedData['id'] = $user->id;
                $nestedData['name'] = $user->name;
                $nestedData['email'] = $user->email;
                $nestedData['email_verified_at'] = date($user->email_verified_at ?? "");
                $nestedData['created_at'] = date($user->created_at ?? "");
                $nestedData['updated_at'] = date($user->updated_at ?? "");
                $nestedData['mobile'] = $user->mobile ?? "";
                $nestedData['profile_pic'] = $user->profile_pic ?? "";
                $nestedData['provider'] = $user->provider;
                $nestedData['total_ordered'] = number_format($user->total_ordered ?? 0);
                $nestedData['amount_spent'] = "$".number_format($user->amount_spent ?? 0);
                $nestedData['last_login_at'] = date($user->last_login_at ?? "") ;
                $nestedData['option_show'] = "<a href='{$show}' title='SHOW' class='btn btn-primary btn-sm'>Show</a>";
                $nestedData['option_edit'] = "<a href='{$edit}' title='EDIT' class='btn btn-warning btn-sm'>Edit</a>";
                $nestedData['option_delete'] = $delete;
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
