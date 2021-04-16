@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<a class="blog-img mr-4" style="background-image: url({{ asset('frontend/images/image_2.jpg') }});"></a>

<div class="img" style="background-image: url({{ asset('frontend/images/products')}});">
                                </div>

<div class="img" style="background-image: url({{ asset('frontend/images/products/'. '.$cart['product_image']).' )}};">
                                </div>
