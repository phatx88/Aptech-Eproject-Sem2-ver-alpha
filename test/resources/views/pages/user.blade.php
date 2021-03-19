@extends('main_layout')
@section('content')

    <section class="hero-wrap hero-wrap-2" style="background-image: url('frontend/images/bg_2.jpg');"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate mb-5 text-center">
                    <p class="breadcrumbs mb-0"><span class="mr-2"><a href="index.html">Home <i
                                    class="fa fa-chevron-right"></i></a></span> <span><a href="product.html">Login <i
                                    class="fa fa-chevron-right"></i></a></span> <span>Profile <i
                                class="fa fa-chevron-right"></i></span></p>
                    <h2 class="mb-0 bread">Account Info</h2>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <img src="{{ asset('frontend/images/avatar.jpg') }}" alt="Avatar" class="avatar">
            </div>
            <div class="text-center m-auto">
                <label for="user-image" style="cursor: pointer">Change <i class="fa fa-upload" aria-hidden="true">
                    </i> </label>
                <input type="file" class="center-block file-upload d-none" id="user-image">
            </div>
            <h3 class="text-center">Welcome (USER)</h3>
            <hr class="mt-5 mb-0">
            <div class="row">
                <div class="col-12 ">
                    <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile"
                                role="tab" aria-controls="nav-profile" aria-selected="false">Profile</a>
                            <a class="nav-item nav-link" id="order-history-tab" data-toggle="tab" href="#order-history"
                                role="tab" aria-controls="order-history" aria-selected="false">Order History</a>
                            <a class="nav-item nav-link" id="edit-profile-tab" data-toggle="tab" href="#edit-profile"
                                role="tab" aria-controls="edit-profile" aria-selected="false">Change Password</a>
                        </div>
                    </nav>
                    <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-profile" role="tabpanel"
                            aria-labelledby="nav-profile-tab">
                            <form action="#" class="billing-form">
                                <h3 class="mb-4 billing-heading">Shipping Info</h3>
                                <div class="row align-items-end">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="firstname">Firt Name</label>
                                            <input type="text" class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lastname">Last Name</label>
                                            <input type="text" class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="w-100"></div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="country">State / Country</label>
                                            <div class="select-wrap">
                                                <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                                <select name="" id="" class="form-control">
                                                    <option value="">France</option>
                                                    <option value="">Italy</option>
                                                    <option value="">Philippines</option>
                                                    <option value="">South Korea</option>
                                                    <option value="">Hongkong</option>
                                                    <option value="">Japan</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="w-100"></div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="streetaddress">Street Address</label>
                                            <input type="text" class="form-control" placeholder="House number and street name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Appartment, suite, unit etc: (optional)">
                                        </div>
                                    </div>
                                    <div class="w-100"></div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="towncity">Town / City</label>
                                            <input type="text" class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="postcodezip">Postcode / ZIP *</label>
                                            <input type="text" class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="w-100"></div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="text" class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="emailaddress">Email Address</label>
                                            <input type="text" class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="w-100"></div>
                                    <div class="col-md-12">
                                        <div class="form-group mt-4">
                                            <div class="radio">
                                                <button class="btn btn-primary mr-3" type="submit" name="optradio"> Update </button>
                                                <button class="btn btn-danger mr-3" type="reset" name="optradio"> Reset</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form><!-- END -->
                        </div>
                    <div class="tab-pane fade" id="order-history" role="tabpanel" aria-labelledby="order-history-tab">
                        Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat
                        veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim.
                        Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim
                        non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor
                        ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore.
                        Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.
                    </div>
                    <div class="tab-pane fade" id="edit-profile" role="tabpanel" aria-labelledby="edit-profile-tab">
                        Et et consectetur ipsum labore excepteur est proident excepteur ad velit occaecat qui minim occaecat
                        veniam. Fugiat veniam incididunt anim aliqua enim pariatur veniam sunt est aute sit dolor anim.
                        Velit non irure adipisicing aliqua ullamco irure incididunt irure non esse consectetur nostrud minim
                        non minim occaecat. Amet duis do nisi duis veniam non est eiusmod tempor incididunt tempor dolor
                        ipsum in qui sit. Exercitation mollit sit culpa nisi culpa non adipisicing reprehenderit do dolore.
                        Duis reprehenderit occaecat anim ullamco ad duis occaecat ex.
                    </div>
                    <div class="container tab-pane fade" id="my-order" role="tabpanel" aria-labelledby="my-order">
                        ORDER STATUS - hidden
                    </div>
                </div>

            </div>
        </div>
        </div>
    </section>


    </div>
    </div>
@endsection
