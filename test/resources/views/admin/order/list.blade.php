@extends('admin_layout')
@section('admin_content')
    <div id="content-wrapper">
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
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>#112</td>
                                    <td>Nguyễn Văn A</td>
                                    <td>0932538468</td>
                                    <td>nguyenvana@gmail.com</td>
                                    <td>Đang xử lý</td>
                                    <td>2019-03-10 15:35:59 </td>
                                    <td>Nguyễn Thị C</td>
                                    <td>0123456789</td>
                                    <td>COD</td>
                                    <td>2,000,000 đ</td>
                                    <td>50,000 đ</td>
                                    <td>2,050,000 đ</td>
                                    <td>278 Hòa Bình, Hiệp Tân, Tân Phú, TP.HCM</td>
                                    <td>2019-03-13</td>
                                    <td>Nguyễn Hữu Lộc</td>
                                    <td> <input type="button" onclick="Confirm('1');" value="Xác nhận"
                                            class="btn btn-info btn-sm"></td>
                                    <td> <input type="button" onclick="Edit('1');" value="Sửa"
                                            class="btn btn-warning btn-sm"></td>
                                    <td> <input type="button" onclick="DELETE('1');" value="Xóa"
                                            class="btn btn-danger btn-sm"></td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td>#113</td>
                                    <td>Nguyễn Văn B</td>
                                    <td>0932538468</td>
                                    <td>nguyenvanb@gmail.com</td>
                                    <td>Đang xử lý</td>
                                    <td>2019-03-10 15:35:59 </td>
                                    <td>Nguyễn Thị D</td>
                                    <td>0123456789</td>
                                    <td>Bank</td>
                                    <td>3,000,000 đ</td>
                                    <td>50,000 đ</td>
                                    <td>3,050,000 đ</td>
                                    <td>278 Hòa Bình, Hiệp Tân, Tân Phú, TP.HCM</td>
                                    <td>2019-03-13</td>
                                    <td>Nguyễn Văn T</td>
                                    <td> </td>
                                    <td> <input type="button" onclick="Edit('1');" value="Sửa"
                                            class="btn btn-warning btn-sm"></td>
                                    <td> <input type="button" onclick="DELETE('1');" value="Xóa"
                                            class="btn btn-danger btn-sm"></td>
                                </tr>
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
@endsection
