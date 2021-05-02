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
                <a href="{{ route('admin.order.export') }}" class="btn btn-success btn-sm">Export</a>
                <a type="button" href="{{ route('admin.order.create') }}" class="btn btn-primary btn-sm" value="Thêm" name="add">Add</a>
                <input type="submit" class="btn btn-danger btn-sm" value="Xóa" name="delete">
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Order List
                    <a type="button" href="{{ route('clear-cache') }}" class="btn btn-success btn-sm float-right">Refresh</a>
                 </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" onclick="checkAll(this)"></th>
                                    <th>Mã</th>
                                    <th>Tên khách hàng</th>
                                    <th>Điện thoai</th>
                                    <th>Email người mua</th>
                                    <th>Trạng Thái</th>
                                    <th>Ngày đặt hàng</th>
                                    <th>Người nhận</th>
                                    <th>Số điện thoại người nhận</th>
                                    <th>Hình thức thanh toán</th>
                                    <th>Tạm tính</th>
                                    <th>Phí giao hàng</th>
                                    <th>Tổng cộng</th>
                                    <th>Địa chỉ giao hàng</th>
                                    <th>Ngày giao</th>
                                    <th>Nhân viên phụ trách</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>{{ $order->id  }}</td>
                                    <td>{{ $order->user->name  ?? "Guest"  }}</td>
                                    <td>{{ $order->user->mobile ?? ""}}</td>
                                    <td>{{ $order->user->email ?? $order->shipping_email}}</td>
                                    <td>{{ $order->getShippingStatus() }}</td>
                                    <td>{{ $order->created_date }}</td>
                                    <td>{{ $order->shipping_fullname }}</td>
                                    <td>{{ $order->shipping_mobile }}</td>
                                    <td>{{ $order->payment_method == 0 ? 'COD':'BANK'}}</td>
                                    <td>${{ $sum = $orderTotals->where("order_id" , '=' , $order->id)->first()->total ?? 0}}</td>
                                    {{-- tạm tính là tổng sum của cột total_price trong bảng order.item where id thuộc về bảng order --}}
                                    <td>{{ $order->shipping_fee }}</td>
                                    <td>${{ $sum + $order->shipping_fee}}</td>
                                    <td>{{ $order->shipping_housenumber_street }}</td>
                                    <td>{{ $order->delivered_date }}</td>
                                    <td></td>
                                    <td>
                                        <a type="button" class="btn btn-info btn-sm" href="{{ route('admin.order.show' , ['order' => $order->id]) }}">Detail</a>
                                    </td>
                                    <td> <a type="button" href="{{ route('admin.order.edit' , ['order' => $order->id]) }}" value=""
                                            class="btn btn-warning btn-sm">Edit</a></td>
                                    <td> 
                                        <form action="{{ route('admin.order.destroy' , ['order' => $order->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" value=""
                                        class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><input type="checkbox" onclick="checkAll(this)"></th>
                                    <th>Mã</th>
                                    <th>Tên khách hàng</th>
                                    <th>Điện thoai</th>
                                    <th>Email</th>
                                    <th>Trạng Thái</th>
                                    <th>Ngày đặt hàng</th>
                                    <th>Người nhận</th>
                                    <th>Số điện thoại người nhận</th>
                                    <th>Hình thức thanh toán</th>
                                    <th>Tạm tính</th>
                                    <th>Phí giao hàng</th>
                                    <th>Tổng cộng</th>
                                    <th>Địa chỉ giao hàng</th>
                                    <th>Ngày giao</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </tfoot>

                        </table>
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
                              <textarea name="description" id="description" class="form-control" rows="10" cols="60"></textarea>
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
@endsection