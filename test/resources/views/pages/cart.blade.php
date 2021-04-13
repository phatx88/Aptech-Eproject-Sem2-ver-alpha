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
                        @if(Session('cart'))
                        @php
                            $subtotal = 0;
                        @endphp
                        @foreach(Session('cart') as $key => $cart)
                        <tr class="alert" role="alert">
                            <td>
                                <label class="checkbox-wrap checkbox-primary">
                                    <input type="checkbox">
                                    <span class="checkmark"></span>
                                </label>
                            </td>
                            <td>
                                <div class="img" style="background-image: url('{{ asset('frontend/images/products/' . $cart['product_image']) }}');"></div>
                            </td>
                            <td>
                                <div class="email">
                                    <span>{{ $cart['product_name'] }}</span>
                                    <span>Fugiat voluptates quasi nemo, ipsa perferendis</span>
                                </div>
                            </td>
                            <td>$35.50</td>
                            <td class="quantity">
                                <div class="input-group">
                                    <form>
                                        @csrf
                                    <input type="number" name="quantity[{{ $cart['product_id'] }}]" class="quantity form-control input-number quantity_cart_edit" data-quantity="{{ $cart['product_id'] }}" data-quantity_value="{{ $cart['product_quantity'] }}" id="quantity_{{ $cart['product_id'] }}" value="{{ $cart['product_quantity'] }}" min="1" max="100">
                                </form>
                                </div>
                            </td>
                            <?php
                                $total = $cart['product_quantity'] * $cart['product_price'];
                            ?>
                            <td>${{ $total }}</td>
                            <td>
                                <button type="button" data-id_delete="{{ $cart['product_id'] }}" class="close delete-cart-product" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true"><i class="fa fa-close"></i></span>
                                </button>
                            </td>
                        </tr>
                        @php
                            $subtotal += $total;
                        @endphp
                        @endforeach
                        @else
                        <tr class="alert" role="alert">
                            <td colspan="7" style="text-align: center;"><?php
                                echo "Quý khách làm ơn thêm giỏ hàng nhé!!!";
                            ?></td>
                        </tr>
                        @endif


                        </tbody>
                    </table>
                </div>
            </div>
            @if(Session('cart'))
            <div class="row justify-content-end">
                <div class="col col-lg-5 col-md-6 mt-5 cart-wrap ftco-animate">
                    <div class="cart-total mb-3">
                        <h3>Cart Totals</h3>
                        <p class="d-flex">
                            <span>Subtotal</span>
                            <span>${{ $subtotal }}</span>
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
                    </div>
                    <p class="text-center"><a href="{{URL::to('check-out')}}" class="btn btn-primary py-3 px-4">Proceed to Checkout</a></p>
                </div>
            </div>
            @endif
        </div>
    </section>
@endsection
