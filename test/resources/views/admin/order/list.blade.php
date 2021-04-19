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
                    <a href="#">Quản lý</a>
                </li>
                <li class="breadcrumb-item active">Đơn hàng</li>
                <li class="breadcrumb-item active">Danh sách</li>
            </ol>
            <!-- DataTables Example -->
            <div class="action-bar">
                <input type="submit" class="btn btn-primary btn-sm" value="Thêm" name="add">
                <input type="submit" class="btn btn-danger btn-sm" value="Xóa" name="delete">
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Order List
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
                                    <td>{{ $order->user->name }}</td>
                                    <td>{{ $order->user->mobile }}</td>
                                    <td>{{ $order->user->email}}</td>
                                    <td>{{ $order->status->name }}</td>
                                    <td>{{ $order->created_date }}</td>
                                    <td>{{ $order->shipping_fullname }}</td>
                                    <td>{{ $order->shipping_mobile }}</td>
                                    <td>{{ $order->payment_method == 0 ? 'COD':'BANK'}}</td>
                                    <td>${{ $sum = $orderItems->where("order_id" , '=' , $order->id)->sum('total_price')}}</td>
                                    {{-- tạm tính là tổng sum của cột total_price trong bảng order.item where id thuộc về bảng order --}}
                                    <td>{{ $order->shipping_fee }}</td>
                                    <td>${{ $sum + $order->shipping_fee}}</td>
                                    <td>{{ $order->shipping_housenumber_street }},
                                        {{ $order->ward->name ?? "" }} , {{ $order->ward->district->name ?? "" }} , {{ $order->ward->district->province->name?? "" }}.
                                    </td>
                                    <td>{{ $order->delivered_date }}</td>
                                    <td></td>
                                    <td> </td>
                                    <td> <input type="button" onclick="Edit('1');" value="Sửa"
                                            class="btn btn-warning btn-sm"></td>
                                    <td> <input type="button" onclick="DELETE('1');" value="Xóa"
                                            class="btn btn-danger btn-sm"></td>
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
                                    <th>Nhân viên phụ trách</th>
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
        <!-- Sticky Footer -->
        @include('admin.footer')
    </div>
@endsection
