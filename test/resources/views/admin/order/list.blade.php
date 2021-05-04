@extends('admin_layout')
@section('admin_content')
    <div id="content-wrapper">
        {{-- @php
            dd($orders);
        @endphp --}}
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard.index') }}">Admin</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.order.index') }}">Order</a>
                </li>
                <li class="breadcrumb-item active">List</li>
            </ol>
            @include('errors.message')


            <!-- DataTables Example -->

            <div class="action-bar">
                <a type="button" href="{{ route('admin.order.create') }}" class="btn btn-primary btn-sm" value="Thêm"
                    name="add">Add</a>
                <input type="submit" class="btn btn-danger btn-sm" value="Xóa" name="delete">
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Order List
                    <a href="{{ route('admin.order.export') }}" class="btn btn-success btn-sm float-right">Export</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatableAjax" class="table table-hover" style="width:100%">
                            @csrf
                            <thead>
                                <tr>
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
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
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
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                        </table>
                        <div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
            {{-- Description Modal --}}
            <div class="modal fade" id="ModalDescription" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <label class="col-md-12 control-label" for="description">Description</label>
                                <div class="col-md-12">
                                    <textarea name="description" id="description" class="form-control" rows="10"
                                        cols="60"></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sticky Footer -->
            @include('admin.footer')
        </div>
    @endsection
    @section('scripts')

        <script>
            $(document).ready(function() {

                //   CKEDITOR.replace('description')
                $('#ModalDescription').on('show.bs.modal', function(event) {
                    //   even.preventDefault()
                    var button = $(event.relatedTarget) // Button that triggered the modal
                    var description = button.data('description') // Extract info from data-* attributes
                    var title = button.data('title') // Extract info from data-* attributes
                    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                    var modal = $(this)
                    modal.find('.modal-title').text('Product Name : ' + title)
                    modal.find('#description').val(description)
                })


            });

        </script>

        <script>
            $(document).ready(function() {
                // var _token = $('input[name="_token"]').val();
                $('#datatableAjax').DataTable({
                    "order": [[ 0, "desc" ]],
                    "autoWidth": 'TRUE',
                    "scrollX": 'TRUE',
                    "lengthMenu": [
                        [5, 10, 25, 50, 100, -1],
                        [5, 10, 25, 50, 100, "All"]
                    ],
                    "columnDefs": [ {
                    targets: 8,
                    render: $.fn.dataTable.render.ellipsis( 30, true )
                    } ],
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url": "{{ url('fetch-order') }}",
                        "dataType": "json",
                        "type": "POST",
                        "data": {
                            _token: "{{ csrf_token() }}"
                        }
                    },
                    "columns": [{
                            "data": "id"
                        },
                        {
                            "data": "created_date"
                        },
                        {
                            "data": "order_status_id"
                        },
                        {
                            "data": "delivered_date"
                        },
                        {
                            "data": "customer_name"
                        },
                        {
                            "data": "shipping_fullname"
                        },
                        {
                            "data": "shipping_email"
                        },
                        {
                            "data": "shipping_mobile"
                        },
                        {
                            "data": "shipping_address"
                        },
                        {
                            "data": "shipping_fee"
                        },
                        {
                            "data": "coupon_discount"
                        },
                        {
                            "data": "amount"
                        },
                        {
                            "data": "total"
                        },
                        {
                            "data": "payment_method"
                        },
                        {
                            "data": "option_show"
                        },
                        {
                            "data": "option_edit"
                        }
                    ]

                });
            });

        </script>

    @endsection
