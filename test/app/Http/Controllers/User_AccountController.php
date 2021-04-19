<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Province;

class User_AccountController extends Controller
{
    /**
     * Contruct of the resource. Checking Credentials
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
       
        $this->middleware(['auth' , 'verified']);
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
        return view('pages.user' , ['user' => $user])->with(compact('province'));
    }

    public function upload(Request $request)
    {   
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        $user = $request->user();

        if($request->hasFile('image')){
            $file = $request->file('image');
            $imageName = $file->getClientOriginalName();
            $imageName = uniqid().$imageName;
            //trỏ tới public 
            $file = $file->move(public_path('frontend\images\profile'), $imageName);

            //delete old-pic
            $oldFile = public_path('frontend\images\profile\\'.$user->profile_pic);
            File::delete($oldFile);
        }
        else{
            $imageName = null;
        }    
        $user->profile_pic = $imageName;
        $user->save();
        return redirect()->route('account.index')->with('success' , "Profile Avater Updated!");
    }   

    public function update(Request $request) {
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
        return redirect()->route('account.index')->with('success' , "Profile Updated!");
    }


}
