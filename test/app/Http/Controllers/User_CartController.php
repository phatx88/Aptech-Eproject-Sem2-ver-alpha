<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
session_start();

class User_CartController extends Controller
{
    public function add_to_cart(Request $request)
    {
        $data = $request->all();
        $product_id = $data['id'];
        $cart = Session('cart');
        if($cart != null) {
            $is_available = 0;
            foreach($cart as $key => $val){
                if($val['product_id'] == $product_id){
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

}