@extends('main_layout')
@section('content')
<div>
    <div class="hero-wrap" style="background-image: url({{asset('frontend/images/bg_2.jpg')}});" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-8 ftco-animate d-flex align-items-end">
                    <div class="text w-100 text-center">
                        <h1 class="display-1 d-block"><span>404</span></h1>
                <h1 class="mb-4 lead">Page Not Found.</h1>
                <p><a href="{{URL::to("/product")}}" class="btn btn-primary py-2 px-4">Back To Shop ?</a>
                    <a href="{{URL::to("/contact")}}" class="btn btn-white btn-outline-white py-2 px-4">Contact Admin</a></p>       
                    </div>
                </div>
            </div>
        </div>
    </div>
  
</div>
@endsection