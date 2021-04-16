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

        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $imageName = $file->getClientOriginalName();
        //trỏ tới public 
        $file = $file->move(public_path('frontend\images\profile'), $imageName);

        //delete old-pic
        $oldFile = public_path('frontend\images\profile\\'.$user->profile_pic);
        File::delete($oldFile);

        $imageName = null;
       
        $user->profile_pic = $imageName;
        $user->save();
        return redirect()->route('account.index')->with('success' , "Product uploaded successfully");
    }   


}
