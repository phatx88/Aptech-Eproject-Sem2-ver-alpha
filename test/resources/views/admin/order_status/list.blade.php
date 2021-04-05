@extends('admin_layout')
@section('admin_content')
<div id="content-wrapper">
    <div class="container-fluid">
       <!-- Breadcrumbs-->
       <ol class="breadcrumb">
          <li class="breadcrumb-item">
             <a href="#">Quản lý</a>
          </li>
          <li class="breadcrumb-item active">Trạng thái đơn hàng</li>
       </ol>
       <!-- DataTables Example -->
       <div class="card mb-3">
          <div class="card-body">
             <div class="table-responsive">
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                       <tr>
                          <th>#</th>
                          <th >Tên </th>
                          <th></th>
                       </tr>
                    </thead>
                    <tbody>
                       <tr>
                           <td>1</td>
                          <td >Đã đặt hàng</td>
                          <td > <input type="button" onclick="Edit('1');" value="Sửa" class="btn btn-warning btn-sm"></td>
                       </tr>
                       <tr>
                            <td>2</td>
                          <td >Đã xác nhận đơn hàng</td>
                          <td > <input type="button" onclick="Edit('2');" value="Sửa" class="btn btn-warning btn-sm"></td>
                       </tr>
                       <tr>
                            <td>3</td>
                          <td >Hoàn tất đóng gói</td>
                          <td > <input type="button" onclick="Edit('3');" value="Sửa" class="btn btn-warning btn-sm"></td>
                       </tr>
                       <tr>
                            <td>4</td>
                          <td >Đang giao hàng</td>
                          <td > <input type="button" onclick="Edit('4');" value="Sửa" class="btn btn-warning btn-sm"></td>
                       </tr>
                <tr>
                   <td>5</td>
                  <td >Đã giao hàng</td>
                  <td > <input type="button" onclick="Edit('5');" value="Sửa" class="btn btn-warning btn-sm"></td>
                </tr>
                <tr>
                   <td>6</td>
                  <td >Đơn hàng bị hủy</td>
                  <td > <input type="button" onclick="Edit('6');" value="Sửa" class="btn btn-warning btn-sm"></td>
                </tr>
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