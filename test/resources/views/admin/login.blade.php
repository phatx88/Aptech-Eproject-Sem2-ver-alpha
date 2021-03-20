@extends('admin_layout')
@section('admin_content')
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/signin.css') }}">
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="#">
                <h1>Password Recover</h1>
                <span>confirm your email</span>
                <input type="email" placeholder="Email" />
                <button>Submit</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="#">
                <h1>Sign in</h1>                         
                <input type="email" placeholder="Email" />
                <input type="password" placeholder="Password" />
                <div class="">
                  <input type="checkbox" value="lsRememberMe" id="rememberMe" class=""> 
                  <label for="rememberMe" class="">Remember me</label>
                </div>
                <button>Submit</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>please login using email and password</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Welcome, Admin!</h1>
                    <p>Click here if you forgot password</p>
                    <button class="ghost" id="signUp">Recover</button>
                </div>
            </div>
        </div>
    </div>



    <script>
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');

        signUpButton.addEventListener('click', () => {
            container.classList.add("right-panel-active");
        });

        signInButton.addEventListener('click', () => {
            container.classList.remove("right-panel-active");
        });

    </script>
@endsection
