<!DOCTYPE html>
<html lang="en">

<head>
    <title>Liquor Store - Free Bootstrap 4 Template by Colorlib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link
        href="https://fonts.googleapis.com/css2?family=Spectral:ital,wght@0,200;0,300;0,400;0,500;0,700;0,800;1,200;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/nouislider.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
</head>

<body>

    <div class="wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-6 d-flex align-items-center">
                    <p class="mb-0 phone pl-md-2">
                        <a href="#" class="mr-2"><span class="fa fa-phone mr-1"></span> +00 1234 567</a>
                        <a href="#"><span class="fa fa-paper-plane mr-1"></span> youremail@email.com</a>
                    </p>
                </div>
                <div class="col-md-6 d-flex justify-content-md-end align-items-center">
                    <div class="social-media mr-4">
                        <p class="mb-0 d-flex">
                            <a href="#" class="d-flex align-items-center justify-content-center"><span
                                    class="fa fa-facebook"><i class="sr-only">Facebook</i></span></a>
                            <a href="#" class="d-flex align-items-center justify-content-center"><span
                                    class="fa fa-twitter"><i class="sr-only">Twitter</i></span></a>
                            <a href="#" class="d-flex align-items-center justify-content-center"><span
                                    class="fa fa-instagram"><i class="sr-only">Instagram</i></span></a>
                            <a href="#" class="d-flex align-items-center justify-content-center"><span
                                    class="fa fa-dribbble"><i class="sr-only">Dribbble</i></span></a>
                        </p>
                    </div>
                    <div class="reg text-white">

                        @guest
                            @if (Route::has('login'))
                                <a href="#registerForm" class="btn-register mr-2 text-white" data-toggle="modal">Sign Up</a>
                            @endif

                            @if (Route::has('register'))
                                <a href="#loginModal" class="btn-login text-white" data-toggle="modal">Log In</a>
                            @endif
                        @else
                            {{-- User drop down menu --}}
                            <a href="{{ route('account.index') }}" class="text-white mr-2">
                                {{ Auth::user()->name }}
                            </a>

                            {{-- User drop down menu --}}
                            <a href="{{ route('logout') }} " class="text-white"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>

                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="{{ URL::to('home') }}">Liquor <span>store</span></a>
            {{-- Shopping cart drop down --}}
            <div class="order-lg-last btn-group">
                <a href="#" class="btn-cart dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <span class="flaticon-shopping-bag"></span>
                    <div class="d-flex justify-content-center align-items-center"><small>3</small></div>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-item d-flex align-items-start" href="#">
                        <div class="img" style="background-image: url({{ asset('frontend/images/prod-1.jpg') }});">
                        </div>
                        <div class="text pl-3">
                            <h4>Bacardi 151</h4>
                            <p class="mb-0"><a href="#" class="price">$25.99</a><span class="quantity ml-3">Quantity:
                                    01</span></p>
                        </div>
                        <div class="pt-3">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true" style="color: #dc3545"><i class="fa fa-close"></i></span>
                            </button>
                        </div>
                    </div>
                    <div class="dropdown-item d-flex align-items-start" href="#">
                        <div class="img" style="background-image: url({{ asset('frontend/images/prod-2.jpg') }});">
                        </div>
                        <div class="text pl-3">
                            <h4>Jim Beam Kentucky Straight</h4>
                            <p class="mb-0"><a href="#" class="price">$30.89</a><span class="quantity ml-3">Quantity:
                                    02</span></p>
                        </div>
                        <div class="pt-3">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true" style="color: #dc3545"><i class="fa fa-close"></i></span>
                            </button>
                        </div>
                    </div>
                    <div class="dropdown-item d-flex align-items-start" href="#">
                        <div class="img" style="background-image: url({{ asset('frontend/images/prod-3.jpg') }});">
                        </div>
                        <div class="text pl-3">
                            <h4>Citadelle</h4>
                            <p class="mb-0"><a href="#" class="price">$22.50</a><span class="quantity ml-3">Quantity:
                                    01</span></p>
                        </div>
                        <div class="pt-3">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true" style="color: #dc3545"><i class="fa fa-close"></i></span>
                            </button>
                        </div>
                    </div>
                    <a class="dropdown-item text-center btn-link d-block w-100" href="{{ URL::to('cart') }}">
                        View All
                        <span class="ion-ios-arrow-round-forward"></span>
                    </a>
                </div>
                {{-- Shopping cart drop down --}}
            </div>
            {{-- Wishlist drop down --}}
            <div class="order-lg-last btn-group">
                <a href="#cart-drop" class="btn-cart dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <span class="flaticon-heart"></span>
                    <div class="d-flex justify-content-center align-items-center"><small>4</small></div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-item d-flex align-items-start" href="#">
                        <div class="img" style="background-image: url({{ asset('frontend/images/prod-3.jpg') }});">
                        </div>
                        <div class="text pl-3">
                            <h4>Bacardi 151</h4>
                            <p class="mb-0"><a href="#" class="price">$25.99</a><span class="quantity ml-3">In Stock:
                                    40</span></p>
                        </div>
                        <div class="pt-3">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true" style="color: #dc3545"><i class="fa fa-close"></i></span>
                            </button>
                        </div>
                    </div>
                    <div class="dropdown-item d-flex align-items-start" href="#">
                        <div class="img" style="background-image: url({{ asset('frontend/images/prod-4.jpg') }});">
                        </div>
                        <div class="text pl-3">
                            <h4>Jim Beam Kentucky Straight</h4>
                            <p class="mb-0"><a href="#" class="price">$30.89</a><span class="quantity ml-3">In Stock:
                                    40</span></p>
                        </div>
                        <div class="pt-3">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true" style="color: #dc3545"><i class="fa fa-close"></i></span>
                            </button>
                        </div>
                    </div>
                    <div class="dropdown-item d-flex align-items-start" href="#">
                        <div class="img" style="background-image: url({{ asset('frontend/images/prod-5.jpg') }});">
                        </div>
                        <div class="text pl-3">
                            <h4>Citadelle</h4>
                            <p class="mb-0"><a href="#" class="price">$22.50</a><span class="quantity ml-3">In Stock:
                                    40</span></p>
                        </div>
                        <div class="pt-3">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true" style="color: #dc3545"><i class="fa fa-close"></i></span>
                            </button>
                        </div>
                    </div>
                    <div class="dropdown-item d-flex align-items-start" href="#">
                        <div class="img" style="background-image: url({{ asset('frontend/images/prod-6.jpg') }});">
                        </div>
                        <div class="text pl-3">
                            <h4>Citadelle</h4>
                            <p class="mb-0"><a href="#" class="price">$22.50</a><span class="quantity ml-3">In Stock:
                                    40</span></p>
                        </div>
                        <div class="pt-3">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true" style="color: #dc3545"><i class="fa fa-close"></i></span>
                            </button>
                        </div>
                    </div>
                    <a class="dropdown-item text-center btn-link d-block w-100" href="{{ URL::to('cart') }}">
                        View All
                        <span class="ion-ios-arrow-round-forward"></span>
                    </a>
                </div>
            </div>
            {{-- Wishlist drop down --}}
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><a href="{{ URL::to('home') }}" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="{{ URL::to('about') }}" class="nav-link">About</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">Products</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown04">
                            <a class="dropdown-item" href="{{ route('home.products.index') }}">Products</a>
                            <a class="dropdown-item" href="{{ URL::to('single-product') }}">Single Product</a>
                            <a class="dropdown-item" href="{{ URL::to('single-blog') }}">Single Blog</a>
                            <a class="dropdown-item" href="{{ URL::to('cart') }}">Cart</a>
                            <a class="dropdown-item" href="{{ URL::to('check-out') }}">Checkout</a>
                            <a class="dropdown-item" href="{{ route('account.index') }}">User Account</a>

                        </div>
                    </li>
                    <li class="nav-item"><a href="{{ URL::to('blog') }}" class="nav-link">Blog</a></li>
                    <li class="nav-item"><a href="{{ URL::to('contact') }}" class="nav-link">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- END nav -->

    @yield('content')

    <footer class="ftco-footer">
        <div class="container">
            <div class="row mb-5">
                <div class="col-sm-12 col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2 logo"><a href="#">Liquor <span>Store</span></a></h2>
                        <p>Far far away, behind the word mountains, far from the countries.</p>
                        <ul class="ftco-footer-social list-unstyled mt-2">
                            <li class="ftco-animate"><a href="#"><span class="fa fa-twitter"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="fa fa-facebook"></span></a></li>
                            <li class="ftco-animate"><a href="#"><span class="fa fa-instagram"></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-12 col-md">
                    <div class="ftco-footer-widget mb-4 ml-md-4">
                        <h2 class="ftco-heading-2">My Accounts</h2>
                        <ul class="list-unstyled">
                            <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>My Account</a></li>
                            <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Register</a></li>
                            <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Log In</a></li>
                            <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>My Order</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-12 col-md">
                    <div class="ftco-footer-widget mb-4 ml-md-4">
                        <h2 class="ftco-heading-2">Information</h2>
                        <ul class="list-unstyled">
                            <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>About us</a></li>
                            <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Catalog</a></li>
                            <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Contact us</a></li>
                            <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Term &amp; Conditions</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-12 col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Quick Link</h2>
                        <ul class="list-unstyled">
                            <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>New User</a></li>
                            <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Help Center</a></li>
                            <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Report Spam</a></li>
                            <li><a href="#"><span class="fa fa-chevron-right mr-2"></span>Faq's</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-12 col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Have a Questions?</h2>
                        <div class="block-23 mb-3">
                            <ul>
                                <li><span class="icon fa fa-map marker"></span><span class="text">203 Fake St. Mountain
                                        View, San Francisco, California, USA</span></li>
                                <li><a href="#"><span class="icon fa fa-phone"></span><span class="text">+2 392 3929
                                            210</span></a></li>
                                <li><a href="#"><span class="icon fa fa-paper-plane pr-4"></span><span
                                            class="text">info@yourdomain.com</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid px-0 py-5 bg-black">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">

                        <p class="mb-0" style="color: rgba(255,255,255,.5);">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>
                                document.write(new Date().getFullYear());

                            </script> All rights reserved | This template is made with <i
                                class="fa fa-heart color-danger" aria-hidden="true"></i> by <a
                                href="https://colorlib.com" target="_blank">Colorlib.com</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Login Modal -->
        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" class="modal-dialog" role="document">
                <div class="modal-content form-wrapper">
                    <div class="close-box" data-dismiss="modal">
                        <i class="fa fa-times fa-2x"></i>
                    </div>
                    <div class="container-fluid mt-5">
                        <form method="POST" action="{{ route('login') }}" id="loginForm">
                            @csrf

                            <div class="form-group text-center heading-section">
                                <h2 id="loginModal">{{ __('Login') }}</h2>
                                <span>Not a member yet? <a href="#register" data-dismiss="modal"
                                        data-toggle="modal">Sign up here</a></span>
                            </div>
                            <div class="form-group" style="position: relative;">
                                <label for="email">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group pb-3" style="position: relative;">
                                <label for="password">{{ __('Password') }}</label>
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <a href="#forgotPassword" data-dismiss="modal" data-toggle="modal"
                                    style="display:block; position: absolute; right: 0;" title="">
                                    Forgot Password?
                                </a>
                            </div>
                            <div class="form-group pb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Keep Me Logged In') }}
                                    </label>
                                </div>
                            </div>
                            <div class="form-group pt-2">
                                <button class="btn btn-info form-control">{{ __('Login') }}</button>
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                            <div class="form-group text-center pt-2 social-login">
                                <h6>OR Continue with</h6>
                                <a href="#" class="google"> <i class="fa fa-google-plus fa-lg"></i> </a>
                                <a href="#" class="facebook"> <i class="fa fa-facebook fa-lg"></i> </a>
                                <a href="#" class="twitter"> <i class="fa fa-twitter fa-lg"></i> </a>
                                <a href="#" class="github"> <i class="fa fa-github fa-lg"></i> </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Register Modal -->
        {{-- <div class="modal fade" id="registerForm" tabindex="-1" role="dialog" aria-labelledby="registerModal"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content form-wrapper">
                    <div class="close-box" data-dismiss="modal">
                        <i class="fa fa-times fa-2x"></i>
                    </div>
                    <div class="container-fluid mt-5">
                        <form method="POST" action="{{ route('register') }}" id="registerForm">
                            @csrf
                            <div class="form-group text-center pb-2 heading-section">
                                <h2 id="registerModal">{{ __('Register') }}</h2>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="name">{{ __('Name') }}</label>
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group" style="position:relative;">
                                <label for="email">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email">
                                <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#loginModal"
                                    style="display: block; position: absolute; right: 0; font-size: 12px;">That's you?
                                    Login</a>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="form-row mb-1">
                                <div class="form-group col">
                                    <label for="password">{{ __('Password') }}</label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group col">
                                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-info form-control">{{ __('Register') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- AJAX test  --}}
        <div class="modal fade" id="registerForm" tabindex="-1" role="dialog" aria-labelledby="registerModal"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content form-wrapper">
                    <div class="close-box" data-dismiss="modal">
                        <i class="fa fa-times fa-2x"></i>
                    </div>
                    <div class="container-fluid mt-5">
                        <form method="POST" url="{{ route('register') }}" id="registerForm">
                            @csrf
                            <div class="form-group text-center pb-2 heading-section">
                                <h2 id="registerModal">{{ __('Register') }}</h2>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="nameInput" >{{ __('Name') }}</label>

                            <div >
                                <input id="nameInput" type="text" class="form-control" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>

                                <span class="invalid-feedback" role="alert" id="nameError">
                                    <strong></strong>
                                </span>
                            </div>
                                    </div>
                            </div>
                            <div class="form-group" style="position:relative;">
                                <label for="emailInput">{{ __('E-Mail Address') }}</label>

                        <div >
                            <input id="emailInput" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email">

                            <span class="invalid-feedback" role="alert" id="emailError">
                                <strong></strong>
                            </span>
                        </div>

                            </div>
                            <div class="form-row mb-1">
                                <div class="form-group col">
                                    <label for="passwordInput">{{ __('Password') }}</label>

                                    <div >
                                        <input id="passwordInput" type="password" class="form-control" name="password" required autocomplete="new-password">
            
                                        <span class="invalid-feedback" role="alert" id="passwordError">
                                            <strong></strong>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group col">
                                    <label for="password-confirm" >{{ __('Confirm Password') }}</label>

                        <div >
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button class="btn btn-info form-control">{{ __('Register') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- forget password Modal --}}
        <div class="modal fade" id="forgotPassword">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content form-wrapper">
                    <div class="close-box" data-dismiss="modal">
                        <i class="fa fa-times fa-2x"></i>
                    </div>
                    <div class="container-fluid mt-5">

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="form-group text-center heading-section">
                                <h2>Forget Password</h2>
                            </div>
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <div class="form-group" style="position: relative;">
                                <label for="email-recover">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group pt-2">
                                <button class="btn btn-info form-control">{{ __('Reset Password') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </footer>



    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
                stroke="#F96D00" />
        </svg></div>



    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ asset('frontend/js/scrollax.min.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false">
    </script>
    <script src="{{ asset('frontend/js/google-map.js') }}"></script>
    <script src="{{ asset('frontend/js/nouislider.min.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>

    {{-- Forcing the login/register modal to stay open --}}
    @if ($errors->has('email') || $errors->has('password'))
        <script>
            $(function() {
                //Make Login Modal to stay open
                $('#loginModal').modal({
                    show: true
                });
            });

        </script>
    @endif
    <script>
        $(function() {
            //Using Ajax on Registering Form 
            $('#registerForm').submit(function(e) {
                e.preventDefault();
                let formData = $(this).serializeArray();
                $(".invalid-feedback").children("strong").text("");         
                $("#registerForm input").removeClass("is-invalid");
                $.ajax({
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('register') }}",
                    data: formData,
                    success: () => window.location.assign("{{ route('login') }}"),
                    error: (response) => {
                        if (response.status === 422) {
                            let errors = response.responseJSON.errors;
                            Object.keys(errors).forEach(function(key) {
                                $("#" + key + "Input").addClass("is-invalid");
                                $("#" + key + "Error").children("strong").text(
                                    errors[key][0]);
                            });
                        } else {
                            window.location.reload();
                        }
                    }
                })
            });
        });

    </script>

    {{-- <script type="text/javascript">
    $(document).ready(function(){
        $('.search_price').click(function(){
            var price_to = $('.price_to').val();
            var price_from = $('.price_from').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url : '{{url('home/products/search_price')}}',
                method: 'POST',
                data: {
                    price_to:price_to,
                    price_from:price_from,
                    _token:_token
                },
                success:function(data){

                }
            });
        });
    });
    </script> --}}
</body>

</html>
