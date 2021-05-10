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
                <li class="breadcrumb-item active">Trash</li>
            </ol>
            {{-- MESSAGE  --}}
            @include('errors.message')
            <!-- DataTables Example -->
            
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Restore List
                    <div class="float-right">
                        <button type="button" onclick="location.reload(true);" class="btn btn-info btn-sm">Refresh</button>
                    </div>
                 </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Actions</th>
                                    <th>Order Id</th>
                                    <th>Created Date</th>
                                    <th>Order Status</th>
                                    <th>Delivered Date</th>
                                    <th>Registered User</th>
                                    <th>Recipient Name</th>
                                    <th>Recipient Email</th>
                                    <th>Recipient Mobile</th>
                                    <th>Recipient Address</th>
                                    <th>Shipping Fee</th>
                                    <th>Coupon Discount</th>
                                    <th>Order Amount</th>
                                    <th>Total</th>
                                    <th>Payment Method</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody >
                                @php
                                    $count = 0;
                                @endphp
                                @foreach ($orders as $order)
                                    <tr>
                                        @can('restore', 'App/Models/Product')
                                        <td><a class="btn btn-success btn-sm" href="{{ URL('admin/order/restore/'.$order->id) }}">Restore</a></td>
                                        @endcan
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->created_date }}</td>
                                        <td>{{ $order->getShippingStatus() }}</td>
                                        <td>{{ $order->delivered_date }}</td>
                                        <td>{{ $order->user->name ?? "" }}</td>
                                        <td>{{ $order->shipping_fullname }}</td>
                                        <td>{{ $order->shipping_email }}</td>
                                        <td>{{ $order->shipping_mobile }}</td>
                                        <td>{{ $order->shipping_housenumber_street }}</td>
                                        <td>${{ $shipping_fee = $order->shipping_fee }}</td>
                                        <td>${{ $coupon = $order->coupon->number ?? 0}}</td>
                                        <td>${{ $sum = $order->orderItem->sum('total_price') }}</td>
                                        <td>${{ $sum - $coupon + $shipping_fee }}</td>
                                        <td>{{ $order->getPayment() }}</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        

        
        <!-- /.container-fluid -->
        <!-- Sticky Footer -->
        @include('admin.footer')
    </div>
    <!-- /.content-wrapper -->
    @endsection





