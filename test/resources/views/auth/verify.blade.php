@extends('layouts.admin_login')

@section('content')
<div class="container" style="width: auto; min-height: auto">
    <div class="row justify-content-center">
        
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
                    <form class="d-block" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">{{ __('Resend Email') }}</button>
                    </form>
                </div>
            </div>
    
    </div>
</div>
@endsection
