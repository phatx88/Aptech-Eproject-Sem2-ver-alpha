<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    protected $pattern = [
        'name' => 'required|regex:/^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+$/i|max:255',
        'email' => 'required|email|unique:users|max:255',
        'password' => 'required|min:8|required_with:password_confirmation|same:password_confirmation',
        'password_confirmation' => 'required|min:8',
        'is_staff' => 'prohibited',
        'is_active' => 'prohibited',
        // 'g-recaptcha-response' => 'required|recaptchav3:register,0.5',
    ];

    protected $messenger = [
        'required' => ':attribute must not be blank',
        'regex' => ':attribute must not contain number or special characters',
        'email' => ':attribute must be in email format.',
        'min' => ':attribute is not less than :min characters',
        'max' => ':attribute is not greater than :max characters',
        'unique' => ':attribute already existed in the database',
        'same' => ':attribute does not match Confirm password',
     ];

     protected $customName = [
        'name' => 'Full Name',
        'email' => 'Email Address',
        'password' => 'Password',
        'password_confirmation' => 'Confirm Password',
     ];

    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;


    //Customer function to route user with 'admin' role
    protected function redirecTo() {
        if (auth()->user()->is_staff == 1) {
            return '/admin';
        }
        return '/home';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, $this->pattern, $this->messenger, $this->customName);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // dd ($data);
        // $role = $data['is_staff'] ?? 0;
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

}
