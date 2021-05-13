@extends('admin_layout')
@section('admin_content')
<div id="content-wrapper">
    <div class="container-fluid">
       <!-- Breadcrumbs-->
       <ol class="breadcrumb">
          <li class="breadcrumb-item">
             <a href="#">Quản lý</a>
          </li>
          <li class="breadcrumb-item active">Tác vụ</li>
       </ol>
       <!-- DataTables Example -->
       <div class="action-bar">
          <input type="submit" class="btn btn-primary btn-sm" value="Thêm" name="add">
       </div>
       <div class="card mb-3">
          <div class="card-body">
             <div class="table-responsive">
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                       <tr>
                          <th># </th>
                          <th>Mã </th>
                          <th>Tên</th>
                          <th></th>
                       </tr>
                    </thead>
                    <tbody>
                        <tr>
                          <td >1</td>
                          <td >list_product</td>
                          <td >Hiển thị danh sách sản phẩm</td>
                          <td > <input type="button" onclick="Edit('1');" value="Sửa" class="btn btn-warning btn-sm"></td>
                       </tr>
                       <tr>
                            <td >2</td>
                          <td >add_product</td>
                          <td >Thêm sản phẩm</td>
                          <td > <input type="button" onclick="Edit('1');" value="Sửa" class="btn btn-warning btn-sm"></td>
                       </tr>
                       <tr>
                            <td >3</td>
                          <td >edit_product</td>
                          <td >Sửa sản phẩm</td>
                          <td > <input type="button" onclick="Edit('1');" value="Sửa" class="btn btn-warning btn-sm"></td>
                       </tr>
                       <tr>
                            <td >4</td>
                          <td >delete_product</td>
                          <td >Xóa sản phẩm</td>
                          <td > <input type="button" onclick="Edit('1');" value="Sửa" class="btn btn-warning btn-sm"></td>
                       </tr>
                       <tr>
                            <td >5</td>
                          <td >list_staff</td>
                          <td >Hiển thị danh sách nhân viên</td>
                          <td > <input type="button" onclick="Edit('1');" value="Sửa" class="btn btn-warning btn-sm"></td>
                       </tr>
                       <tr>
                            <td >6</td>
                          <td >add_staff</td>
                          <td >Thêm nhân viên</td>
                          <td > <input type="button" onclick="Edit('1');" value="Sửa" class="btn btn-warning btn-sm"></td>
                       </tr>
                       <tr>
                            <td >7</td>
                          <td >edit_staff</td>
                          <td >Sửa nhân viên</td>
                          <td > <input type="button" onclick="Edit('1');" value="Sửa" class="btn btn-warning btn-sm"></td>
                       </tr>
                       <tr>
                            <td >8</td>
                          <td >delete_staff</td>
                          <td >Xóa nhân viên</td>
                          <td > <input type="button" onclick="Edit('1');" value="Sửa" class="btn btn-warning btn-sm"></td>
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