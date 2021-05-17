@extends('admin_layout')
@section('admin_content')

    <div id="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard.index') }}">Admin</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.order.index') }}">Order</a>
                </li>
                <li class="breadcrumb-item active">Detail</li>
            </ol>
            <!-- /.row -->
            
            <div class="row">
                <div class="col-sm-12 ">
                    <label for="name" class="control-label">Order: #{{ $order->id }}</label>
                </div>
            </div>
            <div class="row ">
                <div class="col-sm-4 col-lg-2">
                    <label>Customer Name:</label>
                </div>
                <div class="col-sm-8 col-lg-10">

                    @if ($order->customer_id != null)
                        <span>{{ $order->user->name }}</span>
                    @else
                        <span>Guest</span>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4 col-lg-2">
                    <label>Mobile:</label>
                </div>
                <div class="col-sm-8 col-lg-10">
                    <span>{{ $order->user->mobile ?? $order->shipping_mobile }}</span>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4 col-lg-2">
                    <label>Recipient Email:</label>
                </div>
                <div class="col-sm-8 col-lg-10">
                    <span>{{ $order->user->email ?? $order->shipping_email }}</span>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4 col-lg-2">
                    <label>Order Status:</label>
                </div>
                <div class="col-sm-8 col-lg-10">
                    <span>{{ $order->status->name }}</span>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4 col-lg-2">
                    <label>Order Date:</label>
                </div>
                <div class="col-sm-8 col-lg-10">
                    <span>{{ $order->created_date }}</span>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4 col-lg-2 ">
                    <label>Recipient Name:</label>  
                </div>
                <div class="col-sm-8 col-lg-6"> 
                    <span>{{ $order->shipping_fullname }}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 col-lg-2 ">
                    <label>Recipient Phone:</label>  
                </div>
                <div class="col-sm-8 col-lg-6"> 
                    <span>{{ $order->shipping_mobile }}</span>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4 col-lg-2 ">
                    <label>Payment Method</label>  
                </div>
                <div class="col-sm-8 col-lg-6"> 
                    <span>{{ $order->payment_method == 0 ? 'COD' : 'Bank Transfer' }}</span>
                </div>
            </div>


            <div class="row">
                <div class="col-sm-4 col-lg-2 ">
                    <label>Amount:</label>
                </div>
                <div class="col-sm-8 col-lg-6">
                    <span>$
                        @php
                            $sum = 0;
                            $coupon = 0;
                            $shippingfee = 0;
                            $total = 0;
                            foreach ($orderItem as $item) {
                                $sum += $item->total_price;
                            }
                            echo $sum;
                        @endphp
                    </span>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4 col-lg-2">
                    <label>Shipping Fee:</label>
                </div>
                <div class="col-sm-8 col-lg-10">
                    <span>$ {{ $shippingfee += ($order->shipping_fee ?? 0)}}</span>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4 col-lg-2">
                    <label>Coupon Discount:</label>
                </div>
                <div class="col-sm-8 col-lg-10">
                    <span>$ {{ $coupon += ($order->coupon->number ?? 0) }}</span>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4 col-lg-2">
                    <label>Total:</label>
                </div>
                <div class="col-sm-8 col-lg-10">
                    <span>$ {{ $sum + $shippingfee - $coupon}}</span>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4 col-lg-2">
                    <label>Shipping Address:</label>
                </div>
                <div class="col-sm-8 col-lg-10">
                    <span>{{ $order->shipping_housenumber_street }}, {{ $order->ward->name }}, {{ $order->ward->district->name }}, {{ $order->ward->district->province->name }}</span>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4 col-lg-2">
                    <label>Responsible staff:</label>
                </div>
                <div class="col-sm-8 col-lg-10">
                    <span>{{ $order->staff->id.' - ' ?? "" }}{{ $order->staff->user->name.' - ' ?? "" }}{{ $order->staff->job_title ?? "" }}</span>
                </div>
            </div>
            <label class="control-label">Product</label>

            <div class="card mb-3">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Product ID</th>
                                    <th>Product Name</th>
                                    <th>Featured Image</th>
                                    <th>Unit Price</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orderItem as $item)
                                    <tr>
                                        <td></td>
                                        <td>{{ $item->product_id }}</td>
                                        <td>{{ $products->find($item->product_id)->name }}</td>
                                        <td><img
                                                src="{{ asset('frontend/images/products/' . $products->find($item->product_id)->featured_image) }}">
                                        </td>
                                        <td>{{ $item->unit_price }}</td>
                                        <td><span>{{ $item->qty }}</span></td>
                                        <td><span>${{ $item->total_price }}</span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>SubTotal</td>
                                    <td>${{ $sum }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>


            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
        <!-- Sticky Footer -->
        @include('admin.footer')
    </div>
    <!-- /.content-wrapper -->
    </div>
    <!-- /#wrapper -->
@endsection
