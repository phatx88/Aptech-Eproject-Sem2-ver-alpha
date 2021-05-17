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
                <li class="breadcrumb-item active">Edit</li>
            </ol>
            <!-- /.row -->
            @include('errors.message')
            @include('errors.error')
            <form class="spacing" method="post" action="{{ route('admin.order.update', ['order' => $order->id]) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-sm-12 ">
                        <label for="name" class="control-label">Order: #{{ $order->id }}</label>
                        {{-- <input type="hidden" name="id" value="{{ $order->id }}"> --}}
                    </div>
                </div>
                <div class="row ">
                    <div class="col-sm-4 col-lg-2">
                        <label>Customer Name:</label>
                    </div>
                    <div class="col-sm-8 col-lg-6">
                        <select class="form-control" name="customer_id">
                            @if ($order->customer_id != null)
                                <option value="{{ $order->user->id }}">{{ $order->user->name }}</option>
                            @else
                                <option value="">Guest</option>
                            @endif
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ $user->id == $order->id ? 'selected' : '' }}>
                                    {{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4 col-lg-2 ">
                        <label>Recipient Email:</label>
                    </div>
                    <div class="col-sm-8 col-lg-6">
                        <input type="email" name="shipping_email" class="form-control"
                            value="{{ $order->user->email ?? $order->shipping_email }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 col-lg-2 ">
                        <label>Order Status:</label>
                    </div>
                    <div class="col-sm-8 col-lg-6">
                        <select name="order_status_id" class="form-control">
                            @if ($order->order_status_id == 1)
                                <option value="1">Ordered</option>
                                <option value="2" {{ old($order->order_status_id == 2 ? 'selected' : '') }}>Confirmed
                                </option>
                            @else
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->id == 2 ? '' : $status->id }}"
                                        {{ $status->id == $order->status->id ? 'selected' : '' }}>{{ $status->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 col-lg-2 ">
                        <label>Order Date:</label>
                    </div>
                    <div class="col-sm-8 col-lg-6">
                        <span>{{ $order->created_date }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 col-lg-2 ">
                        <label>Recipient Name:</label>
                    </div>
                    <div class="col-sm-8 col-lg-6">
                        <input type="text" name="shipping_fullname" value="{{ $order->shipping_fullname }}"
                            class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 col-lg-2 ">
                        <label>Recipient Phone:</label>
                    </div>
                    <div class="col-sm-8 col-lg-6">
                        <input type="text" name="shipping_mobile" value="{{ $order->shipping_mobile }}"
                            class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4 col-lg-2 ">
                        <label>Payment Method</label>
                    </div>
                    <div class="col-sm-8 col-lg-6">
                        <select name="payment_method" class="form-control">
                            <option {{ $order->payment_method == 0 ? 'selected' : '' }} value="0">COD</option>
                            <option {{ $order->payment_method == 1 ? 'selected' : '' }} value="1">Bank</option>
                        </select>
                    </div>
                </div>

                @unless($order->order_status_id == 4)
                    <div class="row">
                        <div class="col-sm-4 col-lg-2 ">
                            <label>Add Coupon</label>
                        </div>
                        <div class="col-sm-8 col-lg-6">
                            <select name="coupon_id" class="form-control">
                                <option value="">Select Coupon</option>
                                @foreach ($coupons as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $order->coupon_id == $item->id ? 'selected' : '' }}>{{ $item->code }}-
                                        discount: ${{ $item->number }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endunless

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
                    <div class="col-sm-4 col-lg-2 ">
                        <label>Shipping Fee:</label>
                    </div>
                    <div class="col-sm-8 col-lg-6">
                        $ <input type="number" id="shipping_fee" name="shipping_fee" value="{{ $shippingfee += ($order->shipping_fee ?? 0) }}">
                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-4 col-lg-2">
                        <label>Coupon Discount:</label>
                    </div>
                    <div class="col-sm-8 col-lg-10">
                        $ <span id="coupon">{{ $coupon += ($order->coupon->number ?? 0) }}</span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4 col-lg-2 ">
                        <label>Total:</label>
                    </div>
                    <div class="col-sm-8 col-lg-6">
                        <span id="total" data-value="{{ $sum }}">$
                            {{ $total = $sum + $shippingfee - $coupon }}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 col-lg-2">
                        <label>Shipping Address</label>
                    </div>
                    <div class="col-sm-8 col-lg-6">
                        <div class="row">
                            <div class="col-sm-4">
                                <select class="form-control choose province" name="province" id="province">
                                    @if ($order->ward->district != null)
                                        <option value="{{ $order->ward->district->province }}">
                                            {{ $order->ward->district->province->name }}</option>
                                    @else
                                        <option value="">--Chọn Thành phố---</option>
                                    @endif
                                    @foreach ($provinces as $key => $pvin)
                                        <option value="{{ $pvin->id }}">
                                            {{ str_replace(['Thành phố', 'Tỉnh'], '', $pvin->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <select class="form-control choose district" name="district" id="district">
                                    @if ($order->ward->district != null)
                                        <option value="{{ $order->ward->district }}">
                                            {{ $order->ward->district->name }}</option>
                                    @else
                                        <option value="">--Chọn quận huyện---</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <select class="form-control ward check-shipping-fee" name="shipping_ward_id" id="ward">
                                    @if ($order->shipping_ward_id != null)
                                        <option value="{{ $order->shipping_ward_id }}">{{ $order->ward->name }}
                                        </option>
                                    @else
                                        <option value="">--Chọn xã phường---</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-sm-4 col-lg-2 ">
                        <label>Delivered Date:</label>
                    </div>
                    <div class="col-sm-8 col-lg-6">
                        @unless($order->order_status_id == 1)
                            <input type="date" name="delivered_date" value="{{ $order->delivered_date ?? '' }}"
                                class="form-control" required>
                        @endunless
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4 col-lg-2 ">
                        <label>Responsible staff:</label>
                    </div>
                    <div class="col-sm-8 col-lg-6">
                        <select name="staff_id" class="form-control" required>
                            <option value=""></option>
                            <option value="{{ Auth::user()->staff->id }}">
                                {{ Auth::user()->name }}/{{ Auth::user()->staff->job_title }}</option>
                            {{-- @foreach ($staffs as $staff)
                            <option {{ $staff->id === $order->staff_id ? "selected" : "" }} value="{{ $staff->id }}">{{ $staff->user->name }} / {{ $staff->job_title }}</option>                   
                       @endforeach --}}
                        </select>
                    </div>
                </div>

                <label class="control-label">Product</label>
                @if ($order->order_status_id == 1)
                    <div class="form-group">
                        <a class="btn btn-warning btn-sm" type="button"
                            href="{{ route('admin.order.item.index', ['order' => $order->id]) }}">Edit Order Item</a>
                    </div>
                @endif
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        {{-- <th><input type="checkbox" onclick="checkAll(this)"></th> --}}
                                        <th>Product ID</th>
                                        <th>Featured Image</th>
                                        <th>Product Name</th>
                                        <th>Unit Price</th>
                                        <th>Quantity</th>
                                        <th>Total Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orderItem as $item)
                                        <tr>
                                            {{-- <td><input type="checkbox"></td> --}}
                                            <td>{{ $item->product_id }}</td>
                                            <td><img
                                                    src="{{ asset('frontend/images/products/' . $products->find($item->product_id)->featured_image) }}">
                                            </td>
                                            <td>{{ $products->find($item->product_id)->name }}</td>
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
                                        <td>SubTotal</td>
                                        <td>${{ $sum }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="form-action">
                    <input type="submit" class="btn btn-primary btn-sm" value="Save" name="edit"
                        onclick="return confirm('This will pernamently updated this Order. Are you Sure?')">
                </div>
                <br>
            </form>
        </div>


        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    <!-- Sticky Footer -->
    @include('admin.footer')
    </div>
    <!-- /.content-wrapper -->
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.choose').on('change', function() {
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';
                // alert(action);
                // alert(ma_id);
                if (action == 'province') {
                    result = 'district';
                } else if (action == 'district') {
                    result = 'ward';
                }
                $.ajax({
                    url: '{{ url('select-delivery') }}',
                    method: 'POST',
                    data: {
                        action: action,
                        ma_id: ma_id,
                        _token: _token
                    },
                    success: function(data) {
                        // alert (result);
                        $('#' + result).html(data);
                    }
                });
            });
        });

        $(document).ready(function() {
            $('.check-shipping-fee').change(function() {
                var province_id = $('#province').val();
                // var district_id = $('#district').val();
                // var ward_id = $('#ward').val();
                var _token = $('input[name="_token"]').val();
                // alert(province_id);
                // alert(district_id);
                // alert(ward_id);
                $.ajax({
                    url: '{{ url('admin/order/calculate-fee') }}',
                    method: 'POST',
                    data: {
                        province_id: province_id,
                        _token: _token
                    },
                    success: function(data) {
                        // console.log(data);
                        var transport = JSON.parse(data);
                        // console.log(transport);
                        var shipping_fee = transport[0].price;
                        // console.log(shipping_fee);
                        $("#shipping_fee").val(shipping_fee);
                        update_total_fee();
                    }
                });
            });
        });

        $(document).ready(function() {
            $('#shipping_fee').change(function(e) {
                e.preventDefault();
                update_total_fee();
            });

        });

        function update_total_fee() {
            var shipping_fee = $('#shipping_fee').val();
            var discount = $('#coupon').html();
            var sum = $('#total').data('value');
            total = Number(sum) + Number(shipping_fee) - Number(discount);
            $('#total').html('$ ' + total);
        }

    </script>
@endsection
