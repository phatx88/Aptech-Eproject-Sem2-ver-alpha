<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Coupon;
use Illuminate\Support\Facades\Redirect;
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
            echo $count_items;
        }
    }

    public function view_cart(){

        return view('pages/cart');
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
        if($coupon){
            session()->put('coupon', $coupon);
            session()->save();

        }
        return redirect()->back();

    }
}
