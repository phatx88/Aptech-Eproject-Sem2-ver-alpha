<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Carbon;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use File;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user) {
        $user->update([
            'last_login_at' => now()
        ]);

        if ($user->is_staff == 1) {
            return redirect()->route('admin.dashboard.index');
        } else {
            return redirect()->route('home.index');
        }
    }
    //Github Login
    public function redirectToGithub(){
        return Socialite::driver('github')->redirect();
    }

    public function handleGithubCallback(){
        $user = Socialite::driver('github')->user();
        $this->_registerOrLoginUser($user, 'github');
        return redirect()->route('home.index');
    }

    // Google login
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Google callback
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        $this->_registerOrLoginUser($user, 'google');

        // Return home after login
        return redirect()->route('home.index');
    }

    // Facebook login
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    // Facebook callback
    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();

        $this->_registerOrLoginUser($user, 'facebook');

        // Return home after login
        return redirect()->route('home.index');
    }

    // Twitter login
    public function redirectToTwitter()
    {
        return Socialite::driver('twitter')->redirect();
    }

    // Twitter callback
    public function handleTwitterCallback()
    {
        $user = Socialite::driver('twitter')->user();

        $this->_registerOrLoginUser($user, 'twitter');

        // Return home after login
        return redirect()->route('home.index');
    }

    protected function _registerOrLoginUser($data, $driver)
    {
        //search by social email
        if($data->email != null) {
            $user = User::where('email', $data->email)->first();
        } 
        //then search by social id
        else {
            $user = User::where('provider_id', $data->id)->first();
        }
        //if user doesnt existed create new one
        if (!$user) {
            $user = new User();
            $user->name = $data->name;
            $user->email = $data->email;
            $user->provider_id = $data->id;
            $user->provider = $driver;
            if ($data->avatar) {
                $imageid = uniqid();
                getSocialAvatar($data->avatar, $imageid, '\frontend\images\profile\\');
                $user->profile_pic = $imageid.'.jpg';
            }
            $user->email_verified_at = now();
            $user->save();
        }else{
            $user->update([
                'name' => $data->name,
                'provider_id' => $data->id,
                'provider' => $driver

            ]);

        }

        $user->update([
            'last_login_at' => now()
        ]);
        Auth::login($user);
    }

}
