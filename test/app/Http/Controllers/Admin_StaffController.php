<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Role;
use App\Models\User;
use App\Models\Event;
use App\Models\Province;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Mail\StaffWelcome;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\QueryException;

class Admin_StaffController extends Controller
{
    public function generateToken()
    {
    // This is set in the .env file
    $key = config('app.key');

    // Illuminate\Support\Str;
    if (Str::startsWith($key, 'base64:')) {
        $key = base64_decode(substr($key, 7));
    }
    return hash_hmac('sha256', Str::random(64), $key);
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $staffs = Staff::get();

        //Full Calendar Integration
        if($request->ajax())
    	{
    		$data = Event::whereDate('start', '>=', $request->start)
                       ->whereDate('end',   '<=', $request->end)
                       ->get(['id', 'title', 'start', 'end']);
            return response()->json($data);
    	}

        return view('admin.staff.list' , [
            'staffs' => $staffs,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $staff_roles = Role::get();
        $provinces = Province::get();
        return view('admin.staff.add' , [
            'staff_roles' => $staff_roles,
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
            'email' => 'required|email',
            'password' => 'required|same:confirm-password',
            'is_staff' => 'required',
            'role' => 'required|between:1,3',
            'job_title' => 'required'
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
    
        $user = User::where('email' , $request->input('email'))->first();
        if (!$user) {
            $user = User::create($input);
        }
        $user->assignRole($request->input('role'));
        $user->email_verified_at = now();
        $user->save();

        //updating job title
        Staff::where('user_id' , $user->id)->update(['job_title' => $request->input('job_title')]);
        
        //Sending welcome message and set up new user password
        $username = $user->name;
        $useremail = $user->email;
        $token = $this->generateToken(); 
        DB::table('password_resets')->insert(['email' => $user->email, 'token' => bcrypt($token), 'created_at' =>  \Carbon\Carbon::now()->toDateTimeString()]);

        $details = [
            'username' => $username,
            'useremail' => $useremail,
            'token' => $token,
        ];
        Mail::to($useremail)->send(new StaffWelcome($details));

        return redirect()->route('admin.staff.index')
                        ->with('success',"Staff : {$user->name} - {$user->email} created successfully");
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
        $staff_user = User::where('id' , $id)->first();
        $staff_roles = Role::get();
        $provinces = Province::get();
        return view('admin.staff.edit' , [
            'staff_user' => $staff_user,
            'staff_roles' => $staff_roles,
            'provinces' => $provinces,
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
        $this->validate($request, [
            'name' => 'required',
            'is_staff' => 'required',
            'email' => 'prohibited', 
        ]);

        $user = User::where('id' , $id)->first();
        $user->name = $request->name;
        $user->mobile = $request->mobile;
        $user->ward_id = $request->ward_id;
        $user->housenumber_street = $request->housenumber_street;
        $user->save();

        if(!empty($request->role) && !empty($request->job_title)){
        Staff::where('user_id' , $id)->update([
            'role_id' => $request->role,
            'job_title' => $request->job_title
        ]);
        }
        

        return redirect()->route('admin.staff.index')
                        ->with('success',"Staff : {$user->name} - {$user->email} Edit successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $staff)
    {
        try {
            $msg = 'Deleted Product : '.$staff->user->name.' - Staff Id : '.$staff->id.' Successfully';
            $staff->delete();
            request()->session()->put('success', $msg);
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                request()->session()->put('error', $e->getMessage());
            }
        }
        return redirect()->route("admin.staff.index");
    }

    //full Calendar Action
    public function action(Request $request)
    {
    	if($request->ajax())
    	{
    		if($request->type == 'add')
    		{
    			$event = Event::create([
    				'title'		=>	$request->title,
    				'start'		=>	$request->start,
    				'end'		=>	$request->end
    			]);

    			return response()->json($event);
    		}

    		if($request->type == 'update')
    		{
    			$event = Event::find($request->id)->update([
    				'title'		=>	$request->title,
    				'start'		=>	$request->start,
    				'end'		=>	$request->end
    			]);

    			return response()->json($event);
    		}

    		if($request->type == 'delete')
    		{
    			$event = Event::find($request->id)->delete();

    			return response()->json($event);
    		}
    	}
    }

    
}
