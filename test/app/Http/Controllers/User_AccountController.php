<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Province;
use App\Models\Coupon;
use App\Models\WishList;
use App\Models\WishListItem;
class User_AccountController extends Controller
{
    /**
     * Contruct of the resource. Checking Credentials
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {

        $this->middleware(['auth', 'verified']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $province = Province::orderby('id', 'ASC')->get();
        $order_list = array();
        //Order History
        $order_user = Order::where('customer_id', $user->id)->orderBy('id', 'DESC')->get();
        $order_count = $order_user->count();
        if ($order_count > 0) {
            foreach ($order_user as $key => $order) {
                $coupon_fee = 0;
                $coupon = Coupon::where('id', $order->coupon_id)->get();
                foreach ($coupon as $key => $val) {
                    $coupon_fee = $val->number;
                }
                $order_details = OrderItem::where('order_id', $order->id)->get();
                foreach ($order_details as $key => $item) {
                    $order_list[] = array(
                        'order_id' => $order->id,
                        'product_name' => $item->product->name,
                        'product_description' => $item->product->description,
                        'product_quantity' => $item->qty,
                        'product_total_price' => $item->total_price,
                        'product_image' => $item->product->featured_image,
                        'coupon_fee' => $coupon_fee
                    );
                }
            }
        }

        $wish_list = WishList::where('user_id', $user->id)->first();
        if($wish_list != null){
            $wish_list_item = WishListItem::where('wish_list_id', $wish_list->id)->get();
            if($wish_list_item->count() != 0){
                return view('pages.user', ['user' => $user])->with(compact('province'))
                ->with('order_user', $order_user)
                ->with('order_list', $order_list)
                ->with('wish_list_item', $wish_list_item);
            }
        }
        return view('pages.user', ['user' => $user])->with(compact('province'))
            ->with('order_user', $order_user)
            ->with('order_list', $order_list);


    }

    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = $request->user();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = $file->getClientOriginalName();
            $imageName = uniqid() . $imageName;
            //trỏ tới public
            $file = $file->move(public_path('frontend\images\profile'), $imageName);

            //delete old-pic
            if ($user->profile_pic != 'avatar.jpg') {
                $oldFile = public_path('frontend\images\profile\\' . $user->profile_pic);
                File::delete($oldFile);
            }
        } else {
            $imageName = 'avatar.jpg';
        }
        $user->profile_pic = $imageName;
        $user->save();
        return redirect()->route('account.index')->with('success', "Profile Avatar Updated!");
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'max:255',
            'mobile' => 'numeric|min:11',
            'housenumber_street' => 'max:255',
            'ward' => 'integer',
        ]);

        $user = $request->user();

        $user->name = $request->name;
        $user->mobile = $request->mobile;
        $user->housenumber_street = $request->housenumber_street;
        $user->ward_id = $request->ward;

        $user->save();
        return redirect()->route('account.index')->with('success', "Profile Updated!");
    }
}
