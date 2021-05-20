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
                    <form name="check-out-form-with-validation" method="GET">
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
                                    <input type="text" required minlength="3" class="form-control user-name-checkout" placeholder="Enter Shipping Recipient" name="shipping_fullname" id="shipping_fullname" @auth
                                        value="{{ $user->name }}" @endauth>
                                </div>
                            </div>

                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="shipping_mobile">Phone</label>
                                    <input type="text" required class="form-control user-mobile-checkout" placeholder="Enter Your Phone #" id="shipping_mobile" name="shipping_mobile"
                                        @auth value="{{ $user->mobile }}" @endauth>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="shipping_email">Email Address</label>
                                    <input type="text" class="form-control user-email-address" placeholder="" id="shipping_email" name="shipping_email" @auth
                                        value="{{ $user->email }}" @endauth>
                                </div>
                            </div>
                            <h3 class="mb-4 mt-4 billing-heading">Shipping Address Info</h3>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="shipping_housenumber_street">Street Address</label>
                                        <input type="text" class="form-control user-street-address" placeholder="Enter Your Street Number"
                                            name="shipping_housenumber_street" id="shipping_housenumber_street" @auth value="{{ $user->housenumber_street }}"
                                            @endauth>
                                    </div>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6"> <label for="province">City/Province</label>
                                <div class="form-group">
                                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                    <select class="form-control choose province" name="province" id="province">

                                            @if (isset($user) && $user->ward_id != null)
                                                <option value="{{ $user->ward->district->province->id }}">
                                                    {{ $user->ward->district->province->name }}</option>

                                            @elseif($ward != null)
                                                    @foreach($ward as $key => $war)
                                                    <option value="{{ $war->district->province->id }}">
                                                        {{ $war->district->province->name }}</option>

                                                    @endforeach

                                            @else
                                            @endif
                                            <option value="">--Chọn Thành phố---</option>

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

                                            @if (isset($user) && $user->ward_id != null)
                                                <option value="{{ $user->ward->district->id }}">
                                                    {{ $user->ward->district->name }}</option>

                                            @elseif($ward != null)
                                            @foreach($ward as $key => $war)
                                            <option value="{{ $war->district->id }}">
                                                {{ $war->district->name }}</option>

                                            @endforeach
                                            @endif


                                        <option value="">--Chọn quận huyện---</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6"><label for="ward">Ward</label>
                                <div class="form-group">
                                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                    <select class="form-control ward" name="ward" id="ward">

                                            @if (isset($user) && $user->ward_id != null)
                                                <option value="{{ $user->ward_id }}">{{ $user->ward->name }}
                                                </option>

                                                @elseif($ward != null)
                                                @foreach($ward as $key => $war)
                                                <option value="{{ $war->id }}">
                                                    {{ $war->name }}</option>

                                                @endforeach
                                                @endif


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
                                            <a type="button" class="btn btn-primary mr-3 check-shipping-fee" id="">Confirm Shipping Fee</a>
                                        </div>

                                    @endauth
                                </div>
                            </div>
                        </div>


                    @if(Session('coupon'))
                    @foreach(Session('coupon') as $key => $cou)
                    <input type="hidden" class="form-control coupon-fee-checkout" value=" {{ $cou->id }}">
                    @endforeach
                    @else
                    <input type="hidden" class="form-control coupon-fee-checkout" value="">
                    @endif
                    @if(Session('fee'))
                    @foreach(Session('fee') as $key => $fee)
                    @php $shipping_fee = $fee->price @endphp
                        <input type="hidden" class="form-control fee-ship-checkout" value="{{ $shipping_fee }}">
                        @endforeach
                    @else
                        <input type="hidden" class="form-control fee-ship-checkout" value="0">
                    @endif



                    <div class="row mt-5 pt-3 d-flex">
                        <div class="col-md-6 d-flex">
                            <div class="cart-detail cart-total p-3 p-md-4">
                                <h3 class="billing-heading mb-4">Cart Total</h3>
                                @php
                                    $realtotal = 0;
                                    $coupon_fee = 0;
                                    $shipping_fee = 0;
                                    $subtotal = Session('subtotal');
                                @endphp
                                <p class="d-flex">
                                    <span>Subtotal</span>
                                    <span>
                                        @if(session('subtotal'))
                                           $  {{ session('subtotal') }}
                                        @endif
                                    </span>
                                </p>
                                @if(session('fee'))
                                <p class="d-flex">
                                    <span>Delivery</span>
                                    <span>
                                            @foreach(Session('fee') as $key => $fee)
                                            @php $shipping_fee = $fee->price @endphp
                                             $   {{ $fee->price }}
                                            @endforeach
                                    </span>
                                </p>
                                @endif
                                @if(session('coupon'))
                                <p class="d-flex">
                                    <span>Discount</span>
                                    <span>
                                        @if(session('coupon'))
                                            @foreach(Session('coupon') as $key => $cou)
                                            @php $coupon_fee = $cou->number @endphp
                                            $   {{ $cou->number }}
                                            @endforeach
                                        @endif

                                    </span>
                                </p>
                                @endif
                                <hr>
                                <p class="d-flex total-price">
                                    <span>Total</span>
                                    <span>
                                        <?php
                                        $realtotal = $subtotal + $shipping_fee - $coupon_fee;
                                            echo "$".$realtotal;
                                            ?>
                                    </span>
                                </p>
                                <hr>
                                <p><a href="{{ url('cart') }}" class="btn btn-primary py-3 px-4">Review Cart</a></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="cart-detail p-3 p-md-4">
                                <h3 class="billing-heading mb-4 ">Payment Method</h3>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="radio">
                                            <label><input type="radio" class="pay-method-checkout" name="payment_method" value="0" class="mr-2"> Cash On Delivery</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="radio">
                                            <label><input type="radio" class="pay-method-checkout"  name="payment_method" value="1" class="mr-2"> Bank Transfer</label>
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
                                            <label>
                                                <input type="checkbox" class="checkbox-checkout" name="check-box" class="mr-2"
                                                id="toggle-check-box"
                                                > I have read and accept the
                                                terms and conditions

                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <p><input type="submit" disabled="disabled" class="btn btn-primary py-3 px-4 checkout-button" id="checkout-button" value="Place an order"></p>
                            </div>
                        </div>
                    </div>
                </form>
                </div> <!-- .col-md-8 -->
            </div>
        </div>

    </section>
@endsection
