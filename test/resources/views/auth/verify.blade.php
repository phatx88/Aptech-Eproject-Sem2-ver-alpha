@extends('layouts.admin_login')

@section('content')

    <body>
        <link rel="stylesheet" href="{{ asset('backend/css/auth.css') }}">
        <div class="container" style="min-height: 0px; padding: 0px">
       

                        <div class="card">
                            <div class="card-header">
                                <h2>
                                    {{ __('Verify Your Email Address') }}
                                </h2>
                            </div>
                            <div class="card-body">
                                @if (session('resent'))
                                    <div class="alert alert-success" role="alert">
                                        {{ __('A fresh verification link has been sent to your email address.') }}
                                    </div>
                                @endif
                                <p>
                                    {{ __('Before proceeding, please check your email for a verification link.') }}
                                </p>
                                <p>
                                    {{ __('If you did not receive the email click the button below to resend another') }},
                                </p>
                                <div class="row justify-content-center">
                                    <div class="">
                                        <form class="" method="POST" action="{{ route('verification.resend') }}">
                                            @csrf
                                            <button type="submit"
                                                class="">{{ __('Resend Email') }}</button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                
           
        </div>
    </body>

@endsection
