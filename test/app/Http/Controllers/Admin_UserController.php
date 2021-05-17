<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Province;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class Admin_UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = User::where('is_staff' , 0)->pluck('provider')->unique();
        $statuses = User::where('is_staff' , 0)->pluck('is_active')->unique();
        $users = User::where('email_verified_at' , null)->get();
        return view('admin.customer.list' , [
            'providers' => $providers,
            'statuses' => $statuses,
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinces = Province::get();
        return view('admin.customer.add' , [
            'provinces' => $provinces,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|same:confirm-password',
            'is_staff' => 'required',
            'housenumber_street' => 'nullable',
            'ward_id' => 'nullable',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
    
        if($user = User::create($input)){
            return redirect()->route('admin.user.index')
            ->with('success',"Staff : {$user->name} - {$user->email} created successfully");
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $provinces = Province::get();
        if ($user->email_verified_at == null) {
            return view('admin.customer.edit' , [
                'provinces' => $provinces,
                'user' => $user,
            ]);
        }
        return view('admin.customer.show' , [
            'provinces' => $provinces,
            'user' => $user,
        ]);
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $user = User::find($id);
            $msg = 'Deleted User ID : ' . $user->id . ' / '. $user->email .' Successfully ';
            $user->forceDelete();
            request()->session()->put('success', $msg);
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                request()->session()->put('error', $e->getMessage());
            }
        }
        return redirect()->route("admin.user.index");
    }
}
