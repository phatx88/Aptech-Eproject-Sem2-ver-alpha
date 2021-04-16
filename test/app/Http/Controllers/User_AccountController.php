<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $user = $request->user();
        if ($request->hasFile('image')) 
        {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            if ($extension != 'jpg' && $extension != 'png' && $extension != 'jpeg') 
            {
                return redirect()->back()->with('error' , "Only accept Image with extension jpg, png, jpeg");
            }
            $imageName = $file->getClientOriginalName();
            //trỏ tới public 
            $file = $file->move(public_path('frontend\images\profile'), $imageName);

            //delete old-pic
            $oldFile = public_path('img\products\\'.$user->profile_pic);
            File::delete($oldFile);
        } 
        else 
        {
            $imageName = null;
        }
        $user->profile_pic = $imageName;
        $user->save();
        return redirect()->route('account.index')->with('success' , "Product uploaded successfully");
    }   


}
