@extends('admin_layout')
@section('admin_content')
<div id="content-wrapper">
            <div class="container-fluid">
               <!-- Breadcrumbs-->
               <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                     <a href="#">Quản lý</a>
                  </li>
                  <li class="breadcrumb-item active">Khách hàng</li>
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
								<th>Tên </th>
								<th>Email</th>
								<th>Số điện thoại</th>
                                <th>Đăng nhập từ</th>
                                <th>Địa chỉ</th>
                                {{-- <th>Tên người nhận</th>
                                <th>Điện thoại người nhận</th> --}}
                                <th></th>
								<th></th>
								<th></th>
							   </tr>
							</thead>
							<tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td >{{ $user->name }}</td>
                                    <td >{{ $user->email }}</td>
                                    <td >{{ $user->mobile?? }}</td>
                                    <td>{{ $user->provider }}</td>
                                    <td>{{ $user->housenumber_street }}</td>
                                    {{-- <td>{{ $user-> }}</td>
                                    <td>0123456789</td> --}}
                                    {{-- <td>{{ $user->is_active} }}</td> --}}
                                    <td > <input type="button" onclick="Edit('1');" value="Sửa" class="btn btn-warning btn-sm"></td>
                                    <td ><input type="button" onclick="Delete('1');" value="Xóa" class="btn btn-danger btn-sm"></td>
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
            <footer class="sticky-footer">
               <div class="container my-auto">
                  <div class="copyright text-center my-auto">
                     <span>Copyright © Thầy Lộc 2017</span>
                  </div>
               </div>
            </footer>
         </div>
         <!-- /.content-wrapper -->
@endsection
