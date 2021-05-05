<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Support\Facades\Mail;
use Mail;
use App\Models\Ward;
use App\Models\District;
use App\Models\Province;
use App\Models\Transport;
use App\Models\OrderItem;
use App\Models\Order;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Session;
session_start();
class User_CheckOutController extends Controller
{
    public function index() {
        $province = Province::orderby('id', 'ASC')->get();
        $ward_id = session()->get('ward_id');
        $ward = Ward::where('id', $ward_id)->get();
        if (Auth::check()) {
            $user = Auth::user();
            return view('pages.checkout' , ['user' => $user])->with(compact('province'))->with('ward', $ward);
        }

        return view('pages.checkout')->with(compact('province'))->with('ward', $ward);
    }

    public function check_out_shopping(Request $request){
        $data = $request->all();
        $shipping_fee = 0;
        // $pronvince_name = '';
        // $district_name = '';
        // $ward_name = '';
        $transport = Transport::where('province_id', $data['province'])->get();
        foreach($transport as $key => $val){
             $shipping_fee = $val->price;
        }
        $province = Province::where('id', $data['province'])->get();
        // foreach ($province as $key => $prov){
        //     $province_name = $prov->name;
        // }
        // $district = District::where('id', $data['district'])->get();
        // foreach ($district as $key => $dis){
        //     $district_name = $dis->name;
        // }
        // $ward = Ward::where('id', $data['ward'])->get();
        // foreach ($ward as $key => $war){
        //     $ward_name = $war->name;
        // }
        // $address_shipping_checkout = $data['user_street_address'] .', '. $ward_name .', '.$district_name. ', '. $province_name;
        if(Auth::check()) {
            $customer_id = Auth::user()->id;
            $order = new Order();
            $order->customer_id = $customer_id;
            $order->shipping_fullname = $data['user_name'];
            $order->shipping_email = $data['user_email'];
            $order->shipping_mobile = $data['user_mobile'];
            $order->payment_method = $data['pay_method_checkout'];
            $order->coupon_id = $data['coupon_id'];
            $order->shipping_housenumber_street = $data['user_street_address'];
            $order->shipping_ward_id = $data['ward'];
            $order->shipping_fee = $shipping_fee;
            $order->save();
         }else{
            $order = new Order();
            $order->shipping_fullname = $data['user_name'];
            $order->shipping_email = $data['user_email'];
            $order->shipping_mobile = $data['user_mobile'];
            $order->payment_method = $data['pay_method_checkout'];
            $order->coupon_id = $data['coupon_id'];
            $order->shipping_housenumber_street = $data['user_street_address'];
            $order->shipping_ward_id = $data['ward'];
            $order->shipping_fee = $shipping_fee;
            $order->save();
          }
          $province_id = $order->ward->district->province->id;
          $order_id =  $order->id;
          DB::table('province')->where('id' , $province_id)->increment('order_count');
         foreach(Session('cart') as $key => $cart){
            $order_details = new OrderItem();
            $order_details->product_id = $cart['product_id'];
            $order_details->order_id = $order_id;
            $order_details->qty = $cart['product_quantity'];
            $order_details->unit_price = $cart['product_price'];
            $order_details->total_price = $cart['product_quantity'] * $cart['product_price'];
            $order_details->save();
         }

        $order_mail = Order::where('id', $order_id)->get();
        $order_details_mail = OrderItem::where('order_id', $order_id)->get();
        $details[] = [
            'user_name' => $data['user_name'],
            'order_mail' => $order_mail,
            'order_details' => $order_details_mail
        ];

        Mail::to($data['user_email'])->send(new \App\Mail\MyTestMail($details));

            // dd("Email is Sent.");

        Session::forget('cart');
        Session::forget('coupon');
        Session::forget('fee');
        Session::forget('subtotal');
        Session::forget('ward_id');


    }

    public function another_address(){
        if(session()->get('ward_id') != null){
            session()->forget('ward_id');
            return redirect()->back();
        }
        return redirect()->back();
    }
}

