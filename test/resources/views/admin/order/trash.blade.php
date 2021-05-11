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
                        <table class="table table-hover text-center" id="dataTable-3" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Actions</th>
                                    <th class="filter-input">Order Id</th>
                                    <th class="filter-input">Created Date</th>
                                    <th class="filter-select">Order Status</th>
                                    <th class="filter-input">Delivered Date</th>
                                    <th class="filter-input">Registered User</th>
                                    <th class="filter-input">Recipient Name</th>
                                    <th class="filter-input">Recipient Email</th>
                                    <th class="filter-input">Recipient Mobile</th>
                                    <th class="filter-input">Recipient Address</th>
                                    <th class="filter-input">Shipping Fee</th>
                                    <th class="filter-input">Coupon Discount</th>
                                    <th class="filter-input">Order Amount</th>
                                    <th class="filter-input">Total</th>
                                    <th class="filter-select">Payment Method</th>
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
                            <tfoot>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tfoot>
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
    @section('scripts')
    <script>
        $(document).ready(function() {
            var table = $('#dataTable-3').DataTable({
                // flipping horizontal scroll bar in datatables refer to admin.css line 94
                order: [
                    [1, "asc"]
                ],
                autoWidth: 'TRUE',
                scrollX: 'TRUE',
                lengthMenu: [
                    [5, 10, 25, 50, -1],
                    [5, 10, 25, 50, "All"]
                ],
                columnDefs: [{
                    targets: 2,
                    render: $.fn.dataTable.render.ellipsis(15, true)
                }],
            });

            //SEARCH INPUT BY COLUMNS// - put class on top of header

            table.columns('.filter-input').every(function(i) {
                var column = table.column(i);

                // Create the select list and search operation
                var input = $(`<input type='search' class='form-control form-control-sm' placeholder='Search'>`)
                    .appendTo(
                        this.footer()
                    )
                    .on('keyup change', function() {
                        column
                            .search($(this).val())
                            .draw();
                    });
            });

            //SEARCH INPUT BY COLUMNS//


            //SEARCH SELECT BY COLUMNS//

            table.columns('.filter-select').every(function(i) {
                var column = table.column(i);

                // Create the select list and search operation
                var select = $(`<select class='form-control form-control-sm'/>`)
                    .appendTo(
                        this.footer()
                    )
                    .on('change', function() {
                        column
                            .search($(this).val())
                            .draw();
                    });

                // Get the search data for the first column and add to the select list
                select.append($('<option value="">Select</option>'));
                this
                    .cache('search')
                    .sort()
                    .unique()
                    .each(function(d) {
                        select.append($('<option value="' + d + '">' + d + '</option>'));
                    });
            });

            //SEARCH SELECT BY COLUMNS//

        });

    </script>
    @endsection





