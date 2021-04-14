@extends('layouts.admin_login')
@section('content')

    <body>
        <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/signin.css') }}">
        <div class="container" id="container">
            <div class="form-container sign-up-container">
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <h1>Password Reset</h1>
                    <span>Reset by email</span>
                    <input id="email" type="email" placeholder="Confirm Email" class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <button type="submit">
                        {{ __('Submit') }}
                    </button>
                </form>
            </div>
            <div class="form-container sign-in-container">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <h1>Sign in</h1>
                    <input id="email" type="email" placeholder="Enter Email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror



                    <input id="password" type="password" placeholder="Enter Password"
                        class="form-control @error('password') is-invalid @enderror" name="password" required
                        autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror


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
                        <h1>Please Sign In!</h1>
                        <p>please login using email and password</p>
                        <button class="ghost" id="signIn">Sign In</button>
                    </div>
                    <div class="overlay-panel overlay-right">                                     
                        @if (session('status'))
                        <h1>Recover Email Sent</h1>
                        <p>
                            {{ session('status') }}
                        </p>
                        @else
                        <h1>Welcome, User!</h1>    
                        <p>Click here if you forgot password</p>
                        @endif                   
                        <button class="ghost" id="signUp">Recover</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
@endsection
