@extends('layouts.admin_login')
@section('content')

    <body>

        <div class="container" id="container">
            <div class="form-container sign-up-container">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <h1>Register</h1>
                    <span class="float-left">Enter Name, Email & Password</span>
                    <input id="name" type="text" placeholder="Name"
                        class="form-control bg-light @error('name') is-invalid @enderror" name="name"
                        value="{{ old('name') }}" required autocomplete="name" autofocus title="Enter Name">

                    <input id="email" type="email" placeholder="Email"
                        class="form-control bg-light @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" required autocomplete="email" title="Enter Email">

                    <input id="password" type="password" placeholder="Password"
                        class="form-control bg-light @error('password') is-invalid @enderror" name="password" required
                        autocomplete="new-password" title="Enter Password">

                    <input id="password-confirm" type="password" placeholder="Confirm Password"
                        class="form-control bg-light" name="password_confirmation" required autocomplete="new-password"
                        title="Enter Confirm Password">

                    <button type="submit">
                        {{ __('Submit') }}
                    </button>
                </form>
            </div>
            <div class="form-container sign-in-container">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <h1>Sign in</h1>
                    <div class="social-container">
                        <a href="{{ route('login.facebook') }}" class="social"><i class="fab fa-facebook-f"></i></a>
                        <a href="{{ route('login.google') }}" class="social"><i class="fab fa-google"></i></a>
                        <a href="{{ route('login.twitter') }}" class="social"><i class="fab fa-twitter"></i></a>
                    </div>
                    <span>or use your account</span>
                    <input id="email" type="email" placeholder="Email"
                        class="form-control bg-light @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" required autocomplete="email" autofocus title="Enter Email">


                    <input id="password" type="password" placeholder="Password"
                        class="form-control bg-light @error('password') is-invalid @enderror" name="password" required
                        autocomplete="current-password" title="Enter Password">


                        <div class="">
                            <input class="" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember" class="">{{ __('Remember Me') }}</label>
                        </div>
                        <button type="submit">
                            {{ __('Submit') }}
                        </button>
                    </form>
                </div>
                <div class="overlay-container">
                    <div class="overlay">
                        <div class="overlay-panel overlay-left">
                            @if ($errors->any())
                                <h1>Something Wrong!!!</h1>
                                <ul class="my-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            @else
                                <h1>Welcome!</h1>
                                <div class="social-container-signup">
                                    <a href="{{ route('login.facebook') }}" class="social"><i class="fab fa-facebook-f"></i></a>
                                    <a href="{{ route('login.google') }}" class="social"><i class="fab fa-google"></i></a>
                                    <a href="{{ route('login.twitter') }}" class="social"> <i class="fab fa-twitter"></i> </a>
                                </div>
                                <p class="mt-0">Sign up using your social media account or register your email</p>
                            @endif
                            <button class="ghost" id="signIn"> <i class="fa fa-caret-left"></i> Sign In</button>
                        </div>
                        <div class="overlay-panel overlay-right">
                            @if ($errors->any())
                                <h1>Something Wrong!!!</h1>
                                <ul class="my-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                @if (Route::has('password.request'))
                                    <p><a class="text-white" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a></p>
                                @endif
                            @else
                                <h1>Register</h1>
                                <p>Press Below</p>
                            @endif
                            <button class="ghost" id="signUp">New User <i class="fa fa-caret-right"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </body>
    @endsection
