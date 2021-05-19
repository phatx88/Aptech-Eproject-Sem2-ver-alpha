<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Province;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;

class Admin_UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Gate::allows("view-users")) {
            abort(403);
        }
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
        if (!Gate::allows("create-users")) {
            abort(403);
        }
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
        if (!Gate::allows("create-users")) {
            abort(403);
        }
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
            ->with('success',"User : {$user->name} - {$user->email} created successfully");
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
        if (!Gate::allows("update-users")) {
            abort(403);
        }
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
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'prohibited',
            'mobile' => 'nullable',
            'housenumber_street' => 'nullable',
            'ward_id' => 'nullable', 
        ]);

        $user->name = $request->name;
        $user->mobile = $request->mobile;
        $user->ward_id = $request->ward_id;
        $user->housenumber_street = $request->housenumber_street;
        $user->save();

        return redirect()->route('admin.user.index')
        ->with('success',"User : {$user->name} - {$user->email} Edited successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Gate::allows("delete-users")) {
            abort(403);
        }
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
