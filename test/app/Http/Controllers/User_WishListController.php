<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use DB;
use App\Models\Product;
use App\Models\WishListItem;
use App\Models\WishList;
use App\Models\User;
use Auth;
class User_WishListController extends Controller
{
    public function add_to_wishlist(Request $request){
        $data = $request->all();
        $output = '';
        $wish_list = WishList::where('user_id', $data['user_id'])->first();
        if($wish_list == null){
            $wish_list = new WishList();
            $wish_list->user_id = $data['user_id'];
            $wish_list->save();
            $wish_list_item = new WishListItem();
            $wish_list_item->wish_list_id = $wish_list->id;
            $wish_list_item->product_id = $data['product_id'];
            $wish_list_item->save();
        }else{
            $wish_list_item = WishListItem::where('product_id', $data['product_id'])->where('wish_list_id', $wish_list->id)->first();
            if($wish_list_item != null){

            }else{
                $wish_list_item = new WishListItem();
                $wish_list_item->wish_list_id = $wish_list->id;
                $wish_list_item->product_id = $data['product_id'];
                $wish_list_item->save();
            }
        }
        // $list_item = WishListItem::where('wish_list_id', $wish_list->id)->get();
        // $count = 0;
        // foreach($list_item as $key => $value){
        //     $count++;
        // }
        // $output .= '
        //         <a href="#cart-drop" class="btn-cart dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"
        //             aria-haspopup="true" aria-expanded="false">
        //             <span class="flaticon-heart"></span>
        //             <div class="d-flex justify-content-center align-items-center"><small>4</small></div>
        //         </a>
        //         <div class="dropdown-menu dropdown-menu-right">
        //             <div class="dropdown-item d-flex align-items-start" href="#">
        //                 <div class="img" style="background-image: url('. asset('frontend/images/products/'.$wish_list_item->product->featured_image).');">
        //                 </div>
        //                 <div class="text pl-3">
        //                     <h4>'.$wish_list_item->product->name.'1</h4>
        //                     <p class="mb-0"><a href="#" class="price">$'.$wish_list_item->product->price.'</a></p>
        //                 </div>
        //                 <div class="pt-3">
        //                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        //                         <span aria-hidden="true" style="color: #dc3545"><i class="fa fa-close"></i></span>
        //                     </button>
        //                 </div>
        //             </div>

        //             <a class="dropdown-item text-center btn-link d-block w-100" href="">
        //                 View All
        //                 <span class="ion-ios-arrow-round-forward"></span>
        //             </a>
        //         </div>


        // ';

        // echo $output;
    }

    public function roll_button_wishlist(Request $request){

        $output = '';
        if(Auth::check()){
            $user_id = Auth::user()->id;
            $wish_list = WishList::where('user_id', $user_id)->first();

            if($wish_list == null){
                $output .= '
                        <a href="#cart-drop" class="btn-cart dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="flaticon-heart"></span>
                        <div class="d-flex justify-content-center align-items-center"><small>0</small></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item text-center btn-link d-block w-100" href="">
                        View All
                        <span class="ion-ios-arrow-round-forward"></span>
                    </a>
                    </div>
                    ';
            }else{
                $wish_list_items = WishListItem::where('wish_list_id', $wish_list->id)->get();
                $count = 0;
                foreach($wish_list_items as $key => $value){
                    $count++;
                }
                $output .= '
                <a href="#cart-drop" class="btn-cart dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <span class="flaticon-heart"></span>
                    <div class="d-flex justify-content-center align-items-center"><small>'.$count.'</small></div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                ';

                foreach($wish_list_items as $key => $wish_list_item){
                    $output .= '
                        <div class="dropdown-item d-flex align-items-start" href="#">
                        <div class="img" style="background-image: url('. asset('frontend/images/products/'.$wish_list_item->product->featured_image).');">
                        </div>
                        <div class="text pl-3">
                            <h4>'.$wish_list_item->product->name.'1</h4>
                            <p class="mb-0"><a href="#" class="price">$'.$wish_list_item->product->sale_price.'</a></p>
                        </div>
                        <div class="pt-3">
                        <input type="hidden" class="wish_list_id_'.$wish_list_item->product_id.'" value="'.$wish_list_item->wish_list_id.'">
                            <button type="button" class="close delete-wishlist-button" data-dismiss="alert" aria-label="Close" data-id_delete="'.$wish_list_item->product_id.'">
                                <span aria-hidden="true" style="color: #dc3545"><i class="fa fa-close" ></i></span>
                            </button>
                        </div>
                        </div>
                    ';
                }
                $output .= '
                        <a class="dropdown-item text-center btn-link d-block w-100" href="'. route('account.index').'">
                            View All
                            <span class="ion-ios-arrow-round-forward"></span>
                        </a>
                    </div>';
            }
        }else{
                $output .= '
                <a href="#cart-drop" class="btn-cart dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="flaticon-heart"></span>
                <div class="d-flex justify-content-center align-items-center"><small>0</small></div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item text-center btn-link d-block w-100" href="'. route('account.index').'">
                View All
                <span class="ion-ios-arrow-round-forward"></span>
            </a>
            </div>
            ';
        }
        echo $output;
    }

    public function delete_button_wishlist(Request $request){
        $data = $request->all();
        WishListItem::where('wish_list_id', $data['wishlist_id'])->where('product_id', $data['product_id'])->delete();
    }
}
