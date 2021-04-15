<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Coupon;
use Illuminate\Support\Facades\Redirect;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;
use App\Models\Transport;

use Session;
session_start();

class User_CartController extends Controller
{
    public function add_to_cart(Request $request)
    {
        $qty = 0;
        $data = $request->all();
        $product_cart = Product::where('id', $data['id'])->get();
        foreach($product_cart as $key => $pro){
            $qty = $pro->inventory_qty;
        }
        $product_id = $data['id'];
        $cart = Session('cart');
        $output = '';
        if($qty >= $data['product_quantity']){
            if($cart != null) {
                $is_available = 0;
                foreach($cart as $key => $val){
                    if($val['product_id'] == $product_id){
                        $cart[$key]['product_quantity'] += $data['product_quantity'];
                        $is_available++;
                    }
                }
                if($is_available == 0){
                    $cart[] = array(
                        'product_id' =>  $product_id,
                        'product_name' => $data['product_name'],
                        'product_price' => $data['product_price'],
                        'product_quantity' => $data['product_quantity'],
                        'product_image' => $data['product_image']
                    );

                }
            }else{
                $cart[] = array(
                    'product_id' =>  $product_id,
                    'product_name' => $data['product_name'],
                    'product_price' => $data['product_price'],
                    'product_quantity' => $data['product_quantity'],
                    'product_image' => $data['product_image']
                );

            }
            session()->put('cart', $cart);
            session()->save();
            $count_items = 0;
            foreach(session()->get('cart') as $key => $val){
                $count_items++;
            }
            $output .= '
                <a href="#" class="btn-cart dropdown-toggle dropdown-toggle-split"      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="flaticon-shopping-bag"></span>
                    <div id="count_items_cart" class="d-flex justify-content-center align-items-center count_items"><small>'.$count_items.'</small></div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
            ';
            foreach(session()->get('cart') as $key => $cart){
                $output .= '
                        <div class="dropdown-item d-flex align-items-start" href="#">
                        <div class="img" style="background-image: url('. asset('frontend/images/products/'.$cart['product_image']) .');">
                        </div>

                        <div class="text pl-3">
                            <h4>'.$cart['product_name'] .'</h4>
                                <p class="mb-0"><a href="#" class=" ">$'. $cart['product_price'] * $cart['product_quantity'] .'</a>
                                    <span class="quantity ml-3">Quantity: '. $cart['product_quantity'] .'</span>
                                </p>
                        </div>
                    </div>

                ';
            }
            $output .='
                        <a class="dropdown-item text-center btn-link d-block w-100" href="'. url('cart').'">
                        View All
                        <span class="ion-ios-arrow-round-forward"></span>
                    </a>
                </div>
            ';
        }
        echo $output;
    }
    public function view_cart(){
        $province = Province::orderby('id', 'ASC')->get();
        return view('pages/cart')->with(compact('province'));
    }

    public function update_cart_quantity(Request $request){
        $data = $request->all();
        $cart = Session('cart');
        $cart_total = 0;
        if($cart){
            foreach($cart as $key => $val){
                if($val['product_id'] == $data['id']){
                    $cart[$key]['product_quantity'] = $data['quantity'];
                }
                $cart_total += $val['product_quantity'] * $val['product_price'];
            }


        }
        session()->put('cart', $cart);
        session()->save();
        echo $cart_total;
    }

    public function delete_cart_product(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        $cart = Session('cart');
        foreach($cart as $key => $val){
            if($val['product_id'] == $id){
                unset($cart[$key]);
            }
        }
        session()->put('cart', $cart);
        session()->save();
    }

    public function check_coupon(Request $request){
        $data = $request->all();
        $coupon = Coupon::where('code', 'LIKE', $data['coupon_code'])->get();

        $session_coupon = session()->get('coupon');
        if(isset($session_coupon)){
            session()->put('coupon','');
        }

        if($data['coupon_code'] != null){
            if($coupon != null){
                $coupon_count = $coupon->count();
                if($coupon_count > 0){
                    session()->put('coupon', $coupon);
                    session()->save();
                }else{
                    session()->put('coupon','');
                    session()->put('message', 'Coupon is not true!!!');
                    session()->save();
                }
            }else{
                session()->put('coupon','');
                session()->put('message', 'Coupon is not true!!!');
                session()->save();
            }
        }else{
            session()->put('message', 'Coupon cant be blank!!!');
        }
    }
    public function select_delivery(Request $request){
        $data = $request->all();
        if($data['action']){
            $output = '';
            $id = $data['ma_id'];
            if($data['action']  == "province"){

                $select_district = District::where('province_id', $id)
                ->orderby('id', 'ASC')->get();
                $output .= '<option value="" style="text-align: center;">---chọn quận huyện---</option>';
                foreach ($select_district as $key =>  $district){
                    $output .= '<option value="'.$district->id.'">'.$district->name.'</option>';
                }
            }else if($data['action'] == "district"){

                $select_ward = Ward::where('district_id', $id)
                ->orderby('id', 'ASC')->get();
                $output .= '<option value="">---chọn xã phường---</option>';
                foreach($select_ward as $ward){
                    $output .= '<option value="'.$ward->id.'">'.$ward->name.'</option>';
                }
            }
        }
        echo $output;
    }

    public function calculate_fee(Request $request){
        $data = $request->all();

        $transport = Transport::where('province_id', $data['province_id'])->get();
        $output = '';
        // $session_fee = session()->get('fee');
        // if(isset($session_fee)){
        //     session()->put('fee','');
        // }
        if($transport){
            if($transport->count() == 1){
                session()->put('fee', $transport);
            }
        }else{
            session()->put('fee', 20);
        }
        session()->save();

    }

    public function roll_button(Request $request){
        $session_cart = session()->get('cart');
        $output = '';
        $token = csrf_token();
        if(!isset($session_cart)){
            $output .= '
                    <a href="#" class="btn-cart dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="flaticon-shopping-bag"></span>
                        <div id="count_items_cart" class="d-flex justify-content-center align-items-center count_items"><small>0</small></div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-item d-flex align-items-start" href="#">
                        <a class="dropdown-item text-center btn-link d-block w-100" href="'. url('cart').'">
                            View All
                            <span class="ion-ios-arrow-round-forward"></span>
                        </a>
                    </div>
                    </div>
            ';
        }else{
            $count_items = 0;
            foreach(session()->get('cart') as $key => $val){
                $count_items++;
            }
            $output .= '
                <a href="#" class="btn-cart dropdown-toggle dropdown-toggle-split"      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="flaticon-shopping-bag"></span>
                    <div id="count_items_cart" class="d-flex justify-content-center align-items-center count_items"><small>'.$count_items.'</small></div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
            ';
            foreach(session()->get('cart') as $key => $cart){
                $output .= '
                    <div class="dropdown-item d-flex align-items-start" href="#">
                        <div class="img" style="background-image: url('. asset('frontend/images/products/'.$cart['product_image']) .');">
                        </div>

                        <div class="text pl-3">
                            <h4>'.$cart['product_name'] .'</h4>
                                <p class="mb-0"><a href="#" class=" ">$'. $cart['product_price'] * $cart['product_quantity'] .'</a>
                                    <span class="quantity ml-3">Quantity: '. $cart['product_quantity'] .'</span>
                                </p>
                        </div>
                    </div>
                ';
            }
            $output .='
                        <a class="dropdown-item text-center btn-link d-block w-100" href="'. url('cart').'">
                        View All
                        <span class="ion-ios-arrow-round-forward"></span>
                    </a>
                </div>

            ';
        }
        echo $output;
    }
}
