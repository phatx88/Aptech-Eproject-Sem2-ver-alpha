@extends('main_layout')
@section('content')
    <section class="hero-wrap hero-wrap-2" style="background-image: url('frontend/images/bg_2.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate mb-5 text-center">
                    <p class="breadcrumbs mb-0"><span class="mr-2"><a href="index.html">Home <i class="fa fa-chevron-right"></i></a></span> <span>Cart <i class="fa fa-chevron-right"></i></span></p>
                    <h2 class="mb-0 bread">My Cart</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="table-wrap">
                    <table class="table">
                        <thead class="thead-primary">
                        <tr>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>total</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="alert" role="alert">
                            <td>
                                <label class="checkbox-wrap checkbox-primary">
                                    <input type="checkbox" checked>
                                    <span class="checkmark"></span>
                                </label>
                            </td>
                            <td>
                                <div class="img" style="background-image: url(frontend/images/prod-1.jpg);"></div>
                            </td>
                            <td>
                                <div class="email">
                                    <span>Jim Beam Kentucky Straight</span>
                                    <span>Fugiat voluptates quasi nemo, ipsa perferendis</span>
                                </div>
                            </td>
                            <td>$44.99</td>
                            <td class="quantity">
                                <div class="input-group">
                                    <input type="text" name="quantity" class="quantity form-control input-number" value="2" min="1" max="100">
                                </div>
                            </td>
                            <td>$89.98</td>
                            <td>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="fa fa-close"></i></span>
                                </button>
                            </td>
                        </tr>

                        <tr class="alert" role="alert">
                            <td>
                                <label class="checkbox-wrap checkbox-primary">
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </td>
                            <td>
                                <div class="img" style="background-image: url(frontend/images/prod-2.jpg);"></div>
                            </td>
                            <td>
                                <div class="email">
                                    <span>Jim Beam Kentucky Straight</span>
                                    <span>Fugiat voluptates quasi nemo, ipsa perferendis</span>
                                </div>
                            </td>
                            <td>$30.99</td>
                            <td class="quantity">
                                <div class="input-group">
                                    <input type="text" name="quantity" class="quantity form-control input-number" value="1" min="1" max="100">
                                </div>
                            </td>
                            <td>$30.99</td>
                            <td>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="fa fa-close"></i></span>
                                </button>
                            </td>
                        </tr>

                        <tr class="alert" role="alert">
                            <td>
                                <label class="checkbox-wrap checkbox-primary">
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </td>
                            <td>
                                <div class="img" style="background-image: url(frontend/images/prod-3.jpg);"></div>
                            </td>
                            <td>
                                <div class="email">
                                    <span>Jim Beam Kentucky Straight</span>
                                    <span>Fugiat voluptates quasi nemo, ipsa perferendis</span>
                                </div>
                            </td>
                            <td>$35.50</td>
                            <td class="quantity">
                                <div class="input-group">
                                    <input type="text" name="quantity" class="quantity form-control input-number" value="1" min="1" max="100">
                                </div>
                            </td>
                            <td>$35.50</td>
                            <td>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="fa fa-close"></i></span>
                                </button>
                            </td>
                        </tr>

                        <tr class="alert" role="alert">
                            <td>
                                <label class="checkbox-wrap checkbox-primary">
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </td>
                            <td>
                                <div class="img" style="background-image: url(frontend/images/prod-4.jpg);"></div>
                            </td>
                            <td>
                                <div class="email">
                                    <span>Jim Beam Kentucky Straight</span>
                                    <span>Fugiat voluptates quasi nemo, ipsa perferendis</span>
                                </div>
                            </td>
                            <td>$76.99</td>
                            <td class="quantity">
                                <div class="input-group">
                                    <input type="text" name="quantity" class="quantity form-control input-number" value="1" min="1" max="100">
                                </div>
                            </td>
                            <td>$76.99</td>
                            <td>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="fa fa-close"></i></span>
                                </button>
                            </td>
                        </tr>

                        <tr class="alert" role="alert">
                            <td class="border-bottom-0">
                                <label class="checkbox-wrap checkbox-primary">
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </td>
                            <td class="border-bottom-0">
                                <div class="img" style="background-image: url(frontend/images/prod-5.jpg);"></div>
                            </td>
                            <td class="border-bottom-0">
                                <div class="email">
                                    <span>Jim Beam Kentucky Straight</span>
                                    <span>Fugiat voluptates quasi nemo, ipsa perferendis</span>
                                </div>
                            </td>
                            <td class="border-bottom-0">$40.00</td>
                            <td class="quantity border-bottom-0">
                                <div class="input-group">
                                    <input type="text" name="quantity" class="quantity form-control input-number" value="1" min="1" max="100">
                                </div>
                            </td>
                            <td class="border-bottom-0">$40.00</td>
                            <td class="border-bottom-0">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="fa fa-close"></i></span>
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-7 col-md-6 mt-5 cart-wrap ftco-animate">
                    <div class="cart-total mb-3">
                        <h3>Estimated Shipping Cost</h3>
                        <div class="row">
                            <div class="col-4">
                                <label for="country">City</label> 
                            </div>
                             <div class="col-8">
                                <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                <select name="" id="" class="form-control w-75 mb-2" style="height: 36px !important; font-size: 1rem">
                                    <option value="">Select City/Province</option>
                                    <option value="">Italy</option>
                                    <option value="">Philippines</option>
                                    <option value="">South Korea</option>
                                    <option value="">Hongkong</option>
                                    <option value="">Japan</option>
                                </select>
                            </div>                                                                 
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label for="country">District</label> 
                            </div>
                             <div class="col-8">
                                <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                <select name="" id="" class="form-control w-75 mb-2" style="height: 36px !important; font-size: 1rem">
                                    <option value="">Select District</option>
                                    <option value="">Italy</option>
                                    <option value="">Philippines</option>
                                    <option value="">South Korea</option>
                                    <option value="">Hongkong</option>
                                    <option value="">Japan</option>
                                </select>
                            </div>                                                                 
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label for="country">Ward</label> 
                            </div>
                             <div class="col-8">
                                <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                <select name="" id="" class="form-control w-75 mb-2" style="height: 36px !important; font-size: 1rem">
                                    <option value="">Select Ward</option>
                                    <option value="">Italy</option>
                                    <option value="">Philippines</option>
                                    <option value="">South Korea</option>
                                    <option value="">Hongkong</option>
                                    <option value="">Japan</option>
                                </select>
                            </div>                                                                 
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4">
                                <label for="country">Coupon & Discount</label> 
                            </div>
                             <div class="col-8">
                                <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                <input type="text" placeholder="Enter Code" class="form-control w-75 mb-2" style="height: 36px !important; font-size: 1rem">
                            </div>                                                                 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <a href="{{URL::to('check-out')}}" class="btn btn-primary py-3 px-4">Get Quotes</a>
                        </div>
                        <div class="col-6">
                            <a href="{{URL::to('check-out')}}" class="btn btn-primary py-3 px-4">Continue</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6 mt-5 cart-wrap ftco-animate">
                    <div class="cart-total mb-3">
                        <h3>Cart Totals</h3>
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
                        <hr class="mt-5">
                        <p class="d-flex total-price">
                            <span>Total</span>
                            <span>$17.60</span>
                        </p>
                    </div>
                    <p class="text-center"><a href="{{URL::to('check-out')}}" class="btn btn-primary py-3 px-4">Proceed to Checkout</a></p>
                </div>
            </div>
        </div>
    </section>
@endsection
