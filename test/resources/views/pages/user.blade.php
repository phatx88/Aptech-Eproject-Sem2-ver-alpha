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
                <img src="{{ asset('frontend/images/profile'.$user->profile_pic) }}" alt="Avatar" class="avatar">
                @else
                <img src="{{ asset('frontend/images/profile/avatar.jpg') }}" alt="Avatar" class="avatar">
                @endif
            </div>
            <form action="{{ route('account.upload') }}" method="POST" id="avatar_upload" enctype="multipart/form-data">
                @csrf
            <div class="text-center m-auto">
                <label for="profile_pic" style="cursor: pointer">Change <i class="fa fa-upload" aria-hidden="true">
                    </i> </label>
                <input type="file" class="center-block file-upload d-none" id="profile_pic" name="profile_pic" onchange="this.form.submit()">
            </div>
            <div class="text-center m-auto">
                @include('errors.message')            
            </div> 
            </form>
            <h3 class="text-center">Welcome {{ $user->name }}</h3>
            {{-- <hr class="mt-5 mb-0"> --}}
            <div class="row mt-5">
                <div class="col-12 ">
                    <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile"
                                role="tab" aria-controls="nav-profile" aria-selected="false"><span class="lead">
                                    Profile</span> </a>
                            <a class="nav-item nav-link" id="order-history-tab" data-toggle="tab" href="#order-history"
                                role="tab" aria-controls="order-history" aria-selected="false"><span class="lead"> Order
                                    History</span></a>
                            <a class="nav-item nav-link" id="wish-list-tab" data-toggle="tab" href="#wish-list"
                                role="tab" aria-controls="wish-list" aria-selected="false"><span class="lead"> WishList</span></a>
                            <a class="nav-item nav-link" id="edit-profile-tab" data-toggle="tab" href="#edit-profile"
                                role="tab" aria-controls="edit-profile" aria-selected="false"><span class="lead"> Change
                                    Password</span></a>
                        </div>
                    </nav>
                    <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">

                        {{-- TAB PANE - USER INFO --}}
                        <div class="tab-pane fade show active" id="nav-profile" role="tabpanel"
                            aria-labelledby="nav-profile-tab">

                            <form action="#" class="billing-form" method="POST">
                                @csrf
                                <h3 class="mb-4 mt-4 billing-heading">Contact Info</h3>
                                <div class="row align-items-end">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="firstname">Full Name</label>
                                            <input type="text" class="form-control" placeholder="" value="{{ $user->name }}">
                                        </div>
                                    </div>

                                    <div class="w-100"></div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="text" class="form-control" placeholder="Enter Your Phone #" value="{{  $user->mobile }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="emailaddress">Email Address</label>
                                            <input type="text" class="form-control" placeholder="" value="{{ $user->email }} readonly">
                                        </div>
                                    </div>
                                    <h3 class="mb-4 mt-4 billing-heading">Default Address</h3>
                                    <div class="w-100"></div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="streetaddress">Street Address</label>
                                                <input type="text" class="form-control"
                                                    placeholder="Enter Your Street Number" value="{{ $user->housenumber_street }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-100"></div>
                                    <div class="col-md-6"> <label for="province">City/Province</label>
                                        <div class="form-group">
                                            <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                            <select class="form-control choose province" name="province" id="province" >
                                                @if ($user->ward_id != null)
                                                <option value="{{ $user->ward->district->province->id }}">--{{ $user->ward->district->province->name }}---</option>
                                                @else
                                                <option value="">--Chọn Thành phố---</option>
                                                @endif
                                                @foreach($province as $key => $pvin)
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
                                                <option value="{{ $user->ward->district->id }}">--{{ $user->ward->district->name }}---</option>
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
                                                <option value="{{ $user->ward_id }}">--{{ $user->ward->name }}---</option>
                                                @endif
                                                <option value="">--Chọn xã phường---</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="w-100"></div>
                                    <div class="col-md-12">
                                        <div class="form-group mt-4">
                                            <div class="radio">
                                                <button class="btn btn-primary mr-3" type="submit" name="updateinfo"> Update
                                                </button>
                                                <button class="btn btn-danger mr-3" type="reset" name="updateinfo">
                                                    Reset</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- TAB PANE - USER INFO - END -->

                        {{-- TAB PANE - ORDER HISTORY - TRACKING --}}
                        <div class="tab-pane fade" id="order-history" role="tabpanel" aria-labelledby="order-history-tab">
                            <div class="row">
                                <div class="col-6">
                                    <h3 class="mb-4 mt-4 billing-heading">My Orders</h3>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-12">
                                    <!-- Mỗi đơn hàng -->
                                    <div class="row">

                                        {{-- FOREACH ORDER 2 --}}

                                        <div class="col-md-12">
                                            <div role="tablist">
                                                <h5>ORDER
                                                    <a href="#order-detail" id="order-detail-tab" data-toggle="tab"
                                                        role="tab" aria-controls="order-detail" aria-selected="false">#2</a>
                                                </h5>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <span class="date">
                                                        Created date: 02-12-2019 11:12:48
                                                    </span>
                                                    <br>
                                                    <span>
                                                        Order Status: Completed
                                                    </span>
                                                </div>
                                                <div class="col-md-9">
                                                    <span>
                                                        Ship To : {Shipping Name} <br>
                                                        Phone : {Shipping Mobile} <br>
                                                        Address : {Streat Address} , {City} , {District} , {Ward}<br>
                                                    </span>
                                                </div>
                                            </div>

                                            <hr>
                                            <div class="table-responsive-md">
                                                <table class="table table-hover">
                                                    <thead class="thead-primary">
                                                        <tr>
                                                            <th scope="col" class="p-1">Item Feature</th>
                                                            <th scope="col" class="p-1">Description</th>
                                                            <th scope="col" class="p-1">Quantity</th>
                                                            <th scope="col" class="p-1">Price</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        {{-- FOREACH ORDER DETAIL HERE --}}
                                                        <tr>
                                                            <th scope="row" class="p-1">
                                                                <img src="{{ asset('frontend/images/prod-1.jpg') }}"
                                                                    alt="" class="feature-img">
                                                            </th>
                                                            <td class="p-0">Lorem, ipsum dolor sit amet consectetur
                                                                adipisicing elit. Expedita, fugit?</td>
                                                            <td class="p-0 text-center">2</td>
                                                            <td class="p-0 text-center">$60</td>
                                                        </tr>
                                                        {{-- FOREACH ORDER DETAIL HERE --}}
                                                        <tr>
                                                            <th scope="row" class="p-1">
                                                                <img src="{{ asset('frontend/images/prod-2.jpg') }}"
                                                                    alt="" class="feature-img">
                                                            </th>
                                                            <td class="p-0">Lorem ipsum dolor sit amet consectetur
                                                                adipisicing.</td>
                                                            <td class="p-0 text-center">1</td>
                                                            <td class="p-0 text-center">$40</td>
                                                        </tr>
                                                        {{-- FOREACH ORDER DETAIL HERE --}}
                                                        <tr>
                                                            <th scope="row" class="p-1">
                                                                <img src="{{ asset('frontend/images/prod-3.jpg') }}"
                                                                    alt="" class="feature-img">
                                                            </th>
                                                            <td class="p-0">Lorem ipsum, dolor sit amet consectetur
                                                                adipisicing elit. Quibusdam unde ea placeat.</td>
                                                            <td class="p-0 text-center">1</td>
                                                            <td class="p-0 text-center">$100</td>
                                                        </tr>

                                                        {{-- END FOREACH ORDER DETAIL --}}

                                                        <tr class="">
                                                            <th scope="row" class="p-1 border-0"></th>
                                                            <td class="p-0 border-0 text-left">Payment Method : COD</td>
                                                            <td class="p-0 text-left border-0">Subtotal</td>
                                                            <td class="p-0 text-center border-0">$200</td>
                                                        </tr>
                                                        <tr class="">
                                                            <th scope="row" class="p-1 border-0"></th>
                                                            <td class="p-0 border-0"></td>
                                                            <td class="p-0 text-left border-0">Delivery</td>
                                                            <td class="p-0 text-center border-0">$10</td>
                                                        </tr>
                                                        <tr class="">
                                                            <th scope="row" class="p-1"></th>
                                                            <td class="p-0 text-left text-success">Limted Time : Free
                                                                Shipping for New USER</td>
                                                            <td class="p-0 text-left">Discount</td>
                                                            <td class="p-0 text-center"><span
                                                                    class="text-success">-$10</span></td>
                                                        </tr>
                                                        <tr class="">
                                                            <th scope="row" class="p-1"></th>
                                                            <td class="p-0"></td>
                                                            <td class="p-0 text-left">Total</td>
                                                            <td class="p-0 text-center">$200</td>
                                                        </tr>

                                                    </tbody>


                                                </table>
                                            </div>




                                        </div>

                                        {{-- FOREACH ORDER 1 --}}
                                        <div class="col-md-12">
                                            <div role="tablist">
                                                <h5>ORDER
                                                    <a href="#order-detail" id="order-detail-tab" data-toggle="tab"
                                                        role="tab" aria-controls="order-detail" aria-selected="false">#1</a>
                                                </h5>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <span class="date">
                                                        Created date: 02-12-2019 11:12:48
                                                    </span>
                                                    <br>
                                                    <span>
                                                        Order Status: Completed
                                                    </span>
                                                </div>
                                                <div class="col-md-9">
                                                    <span>
                                                        Ship To : {Shipping Name} <br>
                                                        Phone : {Shipping Mobile} <br>
                                                        Address : {Streat Address} , {City} , {District} , {Ward}<br>
                                                    </span>
                                                </div>
                                            </div>

                                            <hr>
                                            <div class="table-responsive-md">
                                                <table class="table table-hover">
                                                    <thead class="thead-primary">
                                                        <tr>
                                                            <th scope="col" class="p-1">Item Feature</th>
                                                            <th scope="col" class="p-1">Description</th>
                                                            <th scope="col" class="p-1">Quantity</th>
                                                            <th scope="col" class="p-1">Price</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        {{-- FOREACH ORDER DETAIL HERE --}}
                                                        <tr>
                                                            <th scope="row" class="p-1">
                                                                <img src="{{ asset('frontend/images/prod-1.jpg') }}"
                                                                    alt="" class="feature-img">
                                                            </th>
                                                            <td class="p-0">Lorem, ipsum dolor sit amet consectetur
                                                                adipisicing elit. Expedita, fugit?</td>
                                                            <td class="p-0 text-center">2</td>
                                                            <td class="p-0 text-center">$60</td>
                                                        </tr>
                                                        {{-- FOREACH ORDER DETAIL HERE --}}
                                                        <tr>
                                                            <th scope="row" class="p-1">
                                                                <img src="{{ asset('frontend/images/prod-2.jpg') }}"
                                                                    alt="" class="feature-img">
                                                            </th>
                                                            <td class="p-0">Lorem ipsum dolor sit amet consectetur
                                                                adipisicing.</td>
                                                            <td class="p-0 text-center">1</td>
                                                            <td class="p-0 text-center">$40</td>
                                                        </tr>
                                                        {{-- FOREACH ORDER DETAIL HERE --}}
                                                        <tr>
                                                            <th scope="row" class="p-1">
                                                                <img src="{{ asset('frontend/images/prod-3.jpg') }}"
                                                                    alt="" class="feature-img">
                                                            </th>
                                                            <td class="p-0">Lorem ipsum, dolor sit amet consectetur
                                                                adipisicing elit. Quibusdam unde ea placeat.</td>
                                                            <td class="p-0 text-center">1</td>
                                                            <td class="p-0 text-center">$100</td>
                                                        </tr>

                                                        {{-- END FOREACH ORDER DETAIL --}}

                                                        <tr class="">
                                                            <th scope="row" class="p-1 border-0"></th>
                                                            <td class="p-0 border-0 text-left">Payment Method : COD</td>
                                                            <td class="p-0 text-left border-0">Subtotal</td>
                                                            <td class="p-0 text-center border-0">$200</td>
                                                        </tr>
                                                        <tr class="">
                                                            <th scope="row" class="p-1 border-0"></th>
                                                            <td class="p-0 border-0"></td>
                                                            <td class="p-0 text-left border-0">Delivery</td>
                                                            <td class="p-0 text-center border-0">$10</td>
                                                        </tr>
                                                        <tr class="">
                                                            <th scope="row" class="p-1"></th>
                                                            <td class="p-0 text-left text-success">Limted Time : Free
                                                                Shipping for New USER</td>
                                                            <td class="p-0 text-left">Discount</td>
                                                            <td class="p-0 text-center"><span
                                                                    class="text-success">-$10</span></td>
                                                        </tr>
                                                        <tr class="">
                                                            <th scope="row" class="p-1"></th>
                                                            <td class="p-0"></td>
                                                            <td class="p-0 text-left">Total</td>
                                                            <td class="p-0 text-center">$200</td>
                                                        </tr>

                                                    </tbody>


                                                </table>
                                            </div>

                                        </div>
                                    </div>

                                    {{-- END FOREACH ORDER --}}
                                </div>
                            </div>
                        </div>
                        {{-- ORDER HISTORY - TRACKING - END --}}

                        {{-- TAB PANE - MY WISH LIST--}}
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
                                                <img src="{{ asset('frontend/images/prod-1.jpg') }}"
                                                    alt="" class="feature-img">
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
                                                <img src="{{ asset('frontend/images/prod-1.jpg') }}"
                                                    alt="" class="feature-img">
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
                                        {{-- END FOREACH--}}
                                    </tbody>
                                </table>
                                <a href="http://localhost/LaravelTest/test/public/product" class="btn btn-primary py-3 px-4 pull-right">Continue Shopping</a>
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
