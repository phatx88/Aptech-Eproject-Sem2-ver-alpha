@extends('main_layout')
@section('content')
    <section class="hero-wrap hero-wrap-2" style="background-image: url('frontend/images/bg_2.jpg');"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate mb-5 text-center">
                    <p class="breadcrumbs mb-0"><span class="mr-2"><a href="index.html">Home <i
                                    class="fa fa-chevron-right"></i></a></span> <span>Checkout <i
                                class="fa fa-chevron-right"></i></span></p>
                    <h2 class="mb-0 bread">Checkout</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10 ftco-animate">
                    <form action="" class="billing-form" method="POST">
                        @csrf
                        <h3 class="mb-4 mt-4 billing-heading">Shipping Contact Info</h3>
                        @include('errors.error')
                        @include('errors.message')
                        @auth 
                        <input type="hidden" name="customer_id" value="{{ $user->id }}">
                        @endauth
                        <div class="row align-items-end">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="shipping_fullname">Full Name</label>
                                    <input type="text" class="form-control" placeholder="Enter Shipping Recipient" name="shipping_fullname" @auth
                                        value="{{ $user->name }}" @endauth>
                                </div>
                            </div>

                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="shipping_mobile">Phone</label>
                                    <input type="text" class="form-control" placeholder="Enter Your Phone #" name="shipping_mobile"
                                        @auth value="{{ $user->mobile }}" @endauth>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="shipping_email">Email Address</label>
                                    <input type="text" class="form-control" placeholder="" name="shipping_email" @auth
                                        value="{{ $user->email }}" @endauth>
                                </div>
                            </div>
                            <h3 class="mb-4 mt-4 billing-heading">Shipping Address Info</h3>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="shipping_housenumber_street">Street Address</label>
                                        <input type="text" class="form-control" placeholder="Enter Your Street Number"
                                            name="shipping_housenumber_street" @auth value="{{ $user->housenumber_street }}"
                                            @endauth>
                                    </div>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6"> <label for="province">City/Province</label>
                                <div class="form-group">
                                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                    <select class="form-control choose province" name="province" id="province">
                                        @auth
                                            @if ($user->ward_id != null)
                                                <option value="{{ $user->ward->district->province->id }}">
                                                    {{ $user->ward->district->province->name }}</option>
                                        @endauth
                                            @else
                                            <option value="">--Chọn Thành phố---</option>
                                            @endif
                                        @foreach ($province as $key => $pvin)
                                            <option value="{{ $pvin->id }}">{{ $pvin->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6"><label for="district">District</label>
                                <div class="form-group">
                                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                    <select class="form-control choose district" name="district" id="district">
                                        @auth
                                            @if ($user->ward_id != null)
                                                <option value="{{ $user->ward->district->id }}">
                                                    {{ $user->ward->district->name }}</option>
                                            @endif
                                        @endauth

                                        <option value="">--Chọn quận huyện---</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6"><label for="ward">Ward</label>
                                <div class="form-group">
                                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                    <select class="form-control ward" name="ward" id="ward">
                                        @auth
                                            @if ($user->ward_id != null)
                                                <option value="{{ $user->ward_id }}">{{ $user->ward->name }}
                                                </option>
                                            @endif
                                        @endauth

                                        <option value="">--Chọn xã phường---</option>
                                    </select>
                                </div>
                            </div>

                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-inline mt-4">
                                    {{-- Là guest thì có option tạo account  --}}
                                    @guest
                                        <div class="radio">
                                            <a class="btn btn-primary mr-3" href="{{ route('login') }}"
                                                id="registerAccount"> Create an Account
                                            </a>
                                        </div>
                                    @endguest
                                    
                                    {{-- đăng nhập rồi thì có thể reset info ship cho người khác  --}}
                                    @auth
                                        <div class="radio">
                                            <input class="btn btn-primary mr-3" value="Ship To Another Address" id="reset">                
                                        </div>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    



                    <div class="row mt-5 pt-3 d-flex">
                        <div class="col-md-6 d-flex">
                            <div class="cart-detail cart-total p-3 p-md-4">
                                <h3 class="billing-heading mb-4">Cart Total</h3>
                                <p class="d-flex">
                                    <span>Subtotal</span>
                                    <span>$20.60</span>
                                </p>
                                <p class="d-flex">
                                    <span>Delivery</span>
                                    <span>$0.00</span>
                                </p>
                                <p class="d-flex">
                                    <span>Discount</span>
                                    <span>$3.00</span>
                                </p>
                                <hr>
                                <p class="d-flex total-price">
                                    <span>Total</span>
                                    <span>$17.60</span>
                                </p>
                                <hr>
                                <p><a href="{{ url('cart') }}" class="btn btn-primary py-3 px-4">Review Cart</a></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="cart-detail p-3 p-md-4">
                                <h3 class="billing-heading mb-4">Payment Method</h3>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="radio">
                                            <label><input type="radio" name="payment_method" value="0" class="mr-2"> Cash On Delivery</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="radio">
                                            <label><input type="radio" name="payment_method" value="1" class="mr-2"> Bank Transfer</label>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="radio">
                                            <label><input type="radio" name="payment_method" class="mr-2"> Paypal</label>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="checkbox">
                                            <label><input type="checkbox" value="" class="mr-2"> I have read and accept the
                                                terms and conditions</label>
                                        </div>
                                    </div>
                                </div>
                                <p><a href="#" class="btn btn-primary py-3 px-4">Place an order</a></p>
                            </div>
                        </div>
                    </div>
                </form>
                </div> <!-- .col-md-8 -->
            </div>
        </div>

    </section>
@endsection
