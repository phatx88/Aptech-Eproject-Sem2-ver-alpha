@extends('main_layout')
@section('content')

    <section class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('frontend/images/bg_2.jpg') }}');"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate mb-5 text-center">
                    <p class="breadcrumbs mb-0"><span class="mr-2"><a href="index.html">Home <i
                                    class="fa fa-chevron-right"></i></a></span> <span><a href="product.html">Login <i
                                    class="fa fa-chevron-right"></i></a></span> <span>User <i
                                class="fa fa-chevron-right"></i></span></p>
                    <h2 class="mb-0 bread">Account Info</h2>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section account-info">
        <div class="container">
            <div class="row">
                @if ($user->profile_pic != null)
                    <img src="{{ asset('frontend/images/profile/' . $user->profile_pic) }}" alt="Avatar" class="avatar">
                @else
                    <img src="{{ asset('frontend/images/profile/avatar.jpg') }}" alt="Avatar" class="avatar">
                @endif
            </div>
            <form action="{{ route('account.upload') }}" method="POST" id="avatar_upload" enctype="multipart/form-data">
                @csrf
                <div class="text-center m-auto">
                    <label for="profile_pic" style="cursor: pointer">Change <i class="fa fa-upload" aria-hidden="true">
                        </i> </label>
                    <input type="file" class="center-block file-upload d-none" id="profile_pic" name="image"
                        onchange="this.form.submit()">
                </div>

            </form>
            <h3 class="text-center">Welcome {{ $user->name }}</h3>
            {{-- <hr class="mt-5 mb-0"> --}}
            <div class="row mt-5">
                <div class="col-12 ">
                    <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link @unless($user->order->find(1)) active show @endunless" id="nav-profile-tab" data-toggle="tab" href="#nav-profile"
                                role="tab" aria-controls="nav-profile" aria-selected="false"><span class="lead">
                                    Profile</span> </a>
                            <a class="nav-item nav-link @if($user->order->find(1)) active show @endif" id="order-history-tab" data-toggle="tab" href="#order-history"
                                role="tab" aria-controls="order-history" aria-selected="false"><span class="lead"> Order
                                    History</span></a>
                            <a class="nav-item nav-link" id="wish-list-tab" data-toggle="tab" href="#wish-list" role="tab"
                                aria-controls="wish-list" aria-selected="false"><span class="lead"> WishList</span></a>
                            <a class="nav-item nav-link" id="edit-profile-tab" data-toggle="tab" href="#edit-profile"
                                role="tab" aria-controls="edit-profile" aria-selected="false"><span class="lead"> Change
                                    Password</span></a>
                        </div>
                    </nav>
                    <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">

                        {{-- TAB PANE - USER INFO --}}
<<<<<<< HEAD
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel"
=======
                        <div class="tab-pane fade @unless($user->order->find(1)) show active @endunless" id="nav-profile" role="tabpanel"
>>>>>>> fb94c52cea0bbda337699f8a1e2f83bac11f5624
                            aria-labelledby="nav-profile-tab">

                            <form action="{{ route('account.update') }}" class="billing-form" method="POST">
                                @csrf
                                <h3 class="mb-4 mt-4 billing-heading">Contact Info</h3>
                                @include('errors.error')
                                @include('errors.message')
                                <div class="row align-items-end">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="firstname">Full Name</label>
                                            <input type="text" class="form-control" placeholder="" name="name"
                                                value="{{ $user->name }}">
                                        </div>
                                    </div>

                                    <div class="w-100"></div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="text" class="form-control" placeholder="Enter Your Phone #"
                                                name="mobile" value="{{ $user->mobile }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="emailaddress">Email Address</label>
                                            <input type="text" class="form-control" placeholder="" name="email"
                                                value="{{ $user->email }}" readonly>
                                        </div>
                                    </div>
                                    <h3 class="mb-4 mt-4 billing-heading">Default Address</h3>
                                    <div class="w-100"></div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="streetaddress">Street Address</label>
                                                <input type="text" class="form-control"
                                                    placeholder="Enter Your Street Number" name="housenumber_street"
                                                    value="{{ $user->housenumber_street }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-100"></div>
                                    <div class="col-md-6"> <label for="province">City/Province</label>
                                        <div class="form-group">
                                            <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                            <select class="form-control choose province" name="province" id="province">
                                                @if ($user->ward_id != null)
                                                    <option value="{{ $user->ward->district->province->id }}">
                                                        {{ $user->ward->district->province->name }}</option>
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
                                                @if ($user->ward_id != null)
                                                    <option value="{{ $user->ward->district->id }}">
                                                        {{ $user->ward->district->name }}</option>
                                                @endif
                                                <option value="">--Chọn quận huyện---</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6"><label for="ward">Ward</label>
                                        <div class="form-group">
                                            <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                            <select class="form-control ward" name="ward" id="ward">
                                                @if ($user->ward_id != null)
                                                    <option value="{{ $user->ward_id }}">{{ $user->ward->name }}
                                                    </option>
                                                @endif
                                                <option value="">--Chọn xã phường---</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="w-100"></div>
                                    <div class="col-md-12">
                                        <div class="form-group mt-4">
                                            <div class="radio">
                                                <button class="btn btn-primary mr-3" type="submit" id="updateinfo"> Update
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- TAB PANE - USER INFO - END -->

                        {{-- TAB PANE - ORDER HISTORY - TRACKING --}}
                        <div class="tab-pane fade @if($user->order->find(1)) active show @endif" id="order-history" role="tabpanel" aria-labelledby="order-history-tab" >
                            <div class="row">
                                <div class="col-6">
                                    <h3 class="mb-4 mt-4 billing-heading">My Orders</h3>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-12">
                                    <!-- Mỗi đơn hàng -->
                                    <div class="row">

                                        {{-- FOREACH ORDER 2 --}}
                                        @if($order_user->count() > 0)
                                        @foreach($order_user as $key => $order)
                                        @php
                                            $coupon_fee = 0;
                                            $subtotal = 0;
                                            $order_id = $order->id
                                        @endphp
                                        <div class="col-md-12">
                                            <div role="tablist">
                                                <h5>ORDER
                                                    <a href="#order-detail" id="order-detail-tab" data-toggle="tab"
                                                        role="tab" aria-controls="order-detail" aria-selected="false"># {{ $order->id }}</a>
                                                </h5>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <span class="date">
                                                        Created date: {{ $order->created_date }}
                                                    </span>
                                                    <br>
                                                    <span>
                                                        Order Status:
                                                        @if($order->order_status_id == 1)
                                                            Uncompleted
                                                        @else
                                                            Completed
                                                        @endif
                                                    </span>
                                                </div>
                                                <div class="col-md-9">
                                                    <span>
                                                        Ship To : {{ $order->shipping_fullname }} <br>
                                                        Phone : {{ $order->shipping_mobile }} <br>
                                                        Address : {{ $order->shipping_housenumber_street }} <br>
                                                    </span>
                                                </div>
                                            </div>

                                            <hr>
                                            <div class="table-responsive-md">
                                                <table class="table table-hover">
                                                    <thead class="thead-primary">
                                                        <tr>
                                                            <th scope="col" class="p-1">Item Feature</th>
                                                            <th scope="col" class="p-1">Product Name</th>
                                                            <th scope="col" class="p-1">Quantity</th>
                                                            <th scope="col" class="p-1">Total Price</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        {{-- FOREACH ORDER DETAIL HERE --}}
                                                        @foreach ($order_list as $valist)
                                                        @if($valist['order_id'] === $order_id)
                                                        @php $coupon_fee = $valist['coupon_fee'] @endphp
                                                        <tr>
                                                            <th scope="row" class="p-1">
                                                                <img src="{{ asset('frontend/images/products/'.$valist['product_image']) }}"
                                                                    alt="" class="feature-img">
                                                            </th>
                                                            <td class="p-0">{{ $valist['product_name'] }}</td>
                                                            <td class="p-0 text-center"> {{ $valist['product_quantity'] }}</td>
                                                            <td class="p-0 text-center">${{ $valist['product_total_price'] }}</td>
                                                        </tr>
                                                        @php
                                                            $subtotal += $valist['product_total_price'];
                                                        @endphp
                                                        @endif
                                                        @endforeach
                                                        @php


                                                            $shipping_fee =  $order->shipping_fee ;

                                                        @endphp

                                                        <tr class="">
                                                            <th scope="row" class="p-1 border-0"></th>
                                                            <td class="p-0 border-0 text-left">Payment Method :
                                                                @if($order->payment_method == 1)
                                                                    Banking
                                                                @else
                                                                    COD
                                                                @endif
                                                            </td>
                                                            <td class="p-0 text-left border-0">Subtotal</td>
                                                            <td class="p-0 text-center border-0">${{ $subtotal }}</td>
                                                        </tr>
                                                        <tr class="">
                                                            <th scope="row" class="p-1 border-0"></th>
                                                            <td class="p-0 border-0"></td>
                                                            <td class="p-0 text-left border-0">Delivery</td>
                                                            <td class="p-0 text-center border-0">${{ $shipping_fee }}</td>
                                                        </tr>
                                                        @if($coupon_fee != 0)
                                                        <tr class="">
                                                            <th scope="row" class="p-1"></th>
                                                            <td class="p-0 border-0"></td>
                                                            <td class="p-0 text-left">Discount</td>

                                                            <td class="p-0 text-center"><span
                                                                    class="text-success">${{$coupon_fee}}</span></td>
                                                        </tr>
                                                        @endif
                                                        <tr class="">
                                                            <th scope="row" class="p-1"></th>
                                                            <td class="p-0"></td>
                                                            <td class="p-0 text-left">Total</td>
                                                            @php
                                                                $total = $subtotal - $coupon_fee + $shipping_fee;
                                                            @endphp
                                                            <td class="p-0 text-center">${{ $total }}</td>
                                                        </tr>

                                                    </tbody>


                                                </table>
                                            </div>




                                        </div>
                                        @endforeach
                                        @endif

                                </div>
                            </div>
                        </div>
                        {{-- ORDER HISTORY - TRACKING - END --}}

                        {{-- TAB PANE - MY WISH LIST --}}
                        <div class="tab-pane fade" id="wish-list" role="tabpanel" aria-labelledby="wish-list-tab">
                            <div class="table-responsive-md">
                                <table class="table table-hover">
                                    <h3 class="mb-4 mt-4 billing-heading">My WishList</h3>
                                    <thead class="thead-primary">
                                        <tr>
                                            <th scope="col" class="p-1">Item Feature</th>
                                            <th scope="col" class="p-1">Description</th>
                                            <th scope="col" class="p-1">Price</th>
                                            <th scope="col" class="p-1">Availiability</th>
                                            <th scope="col" class="p-1">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        {{-- FOREACH HERE --}}
                                        <tr>
                                            <th scope="row" class="p-1">
                                                <img src="{{ asset('frontend/images/prod-1.jpg') }}" alt=""
                                                    class="feature-img">
                                            </th>
                                            <td class="p-0">Lorem, ipsum dolor sit amet consectetur
                                                adipisicing elit. Expedita, fugit?</td>
                                            <td class="p-0 text-center">$60</td>
                                            <td class="p-0 text-center">In Stock : 40</td>
                                            <td class="p-0 text-center">
                                                <button type="button" class="bg-warning" data-dismiss="alert" aria-label="">
                                                    <span aria-hidden="true"><i class="fa fa-shopping-cart"></i></span>
                                                </button>
                                                <button type="button" class="bg-danger" data-dismiss="alert" aria-label="">
                                                    <span aria-hidden="true"><i class="fa fa-close"></i></span>
                                                </button>

                                            </td>
                                        </tr>
                                        {{-- FOREACH HERE --}}
                                        <tr>
                                            <th scope="row" class="p-1">
                                                <img src="{{ asset('frontend/images/prod-1.jpg') }}" alt=""
                                                    class="feature-img">
                                            </th>
                                            <td class="p-0">Lorem, ipsum dolor sit amet consectetur
                                                adipisicing elit. Expedita, fugit?</td>
                                            <td class="p-0 text-center">$60</td>
                                            <td class="p-0 text-center">In Stock : 40</td>
                                            <td class="p-0 text-center">
                                                <button type="button" class="bg-warning" data-dismiss="alert" aria-label="">
                                                    <span aria-hidden="true"><i class="fa fa-shopping-cart"></i></span>
                                                </button>
                                                <button type="button" class="bg-danger" data-dismiss="alert" aria-label="">
                                                    <span aria-hidden="true"><i class="fa fa-close"></i></span>
                                                </button>

                                            </td>
                                        </tr>
                                        {{-- END FOREACH --}}
                                    </tbody>
                                </table>
                                <a href="http://localhost/LaravelTest/test/public/product"
                                    class="btn btn-primary py-3 px-4 pull-right">Continue Shopping</a>
                            </div>

                        </div>
                        <!-- END -->

                        {{-- TAB PANE - CHANGE PASSWORD --}}
                        <div class="tab-pane fade" id="edit-profile" role="tabpanel" aria-labelledby="edit-profile-tab">

                            <form action="#" class="billing-form">
                                <h3 class="mb-4 mt-4 billing-heading">Change Password</h3>
                                <div class="row align-items-end">
                                    <div class="w-100"></div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="oldpass">Current Password</label>
                                                <input type="text" class="form-control" placeholder="" id="oldpass"
                                                    name="oldpass">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-100"></div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="newpass">New Password</label>
                                                <input type="text" class="form-control" placeholder="" id="newpass"
                                                    name="newpass">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="w-100"></div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="confirmpass">Confirm New Password</label>
                                                <input type="text" class="form-control" placeholder="" id="confirmpass"
                                                    name="confirmpass">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-100"></div>
                                    <div class="col-md-12">
                                        <div class="form-group mt-4">
                                            <div class="radio">
                                                <button class="btn btn-primary mr-3" type="submit" name="Savepass"> Save
                                                </button>
                                                <button class="btn btn-danger mr-3" type="reset" name="Savepass">
                                                    Reset</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- END -->


                    </div>

                </div>
            </div>
        </div>
    </section>


    </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            $('#updateinfo').click(function(e) {
                e.preventDefault();
                var form = $(this).parents('form');
                swal({
                    title: "Are you sure?",
                    text: "Your Current Profile Info Will Be Lost!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Confirm!",
                    closeOnConfirm: false
                }, function(isConfirm) {
                    if (isConfirm) form.submit();
                });

            });


        });

    </script>
@endsection
