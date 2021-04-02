@extends('admin_layout')
@section('admin_content')
<div id="content-wrapper">
    <div class="container-fluid">
       <!-- Breadcrumbs-->
       <ol class="breadcrumb">
          <li class="breadcrumb-item">
             <a href="#">Quản lý</a>
          </li>
          <li class="breadcrumb-item active">Danh mục</li>
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
                         <th >Tên</th>
                         <th>
                         </th>
                         <th>
                         </th>
                      </tr>
                   </thead>
                   <tbody>
                      <tr>
                         <td><input type="checkbox"></td>
                         <td >Kem Chống Nắng</td>
                         <td > <input type="button" onclick="Edit('1');" value="Sửa" class="btn btn-warning btn-sm"></td>
                         <td ><input type="button" onclick="Delete('1');" value="Xóa" class="btn btn-danger btn-sm"></td>
                      </tr>
                      <tr>
                         <td><input type="checkbox"></td>
                         <td >Kem Dưỡng Da</td>
                         <td > <input type="button" onclick="Edit('2');" value="Sửa" class="btn btn-warning btn-sm"></td>
                         <td ><input type="button" onclick="Delete('2');" value="Xóa" class="btn btn-danger btn-sm"></td>
                      </tr>
                      <tr>
                         <td><input type="checkbox"></td>
                         <td >Kem Trị Mụn</td>
                         <td > <input type="button" onclick="Edit('3');" value="Sửa" class="btn btn-warning btn-sm"></td>
                         <td ><input type="button" onclick="Delete('3');" value="Xóa" class="btn btn-danger btn-sm"></td>
                      </tr>
                      <tr>
                         <td><input type="checkbox"></td>
                         <td >Kem Trị Thâm Nám</td>
                         <td > <input type="button" onclick="Edit('4');" value="Sửa" class="btn btn-warning btn-sm"></td>
                         <td ><input type="button" onclick="Delete('4');" value="Xóa" class="btn btn-danger btn-sm"></td>
                      </tr>
                      <tr>
                         <td><input type="checkbox"></td>
                         <td >Sữa Rửa Mặt</td>
                         <td > <input type="button" onclick="Edit('5');" value="Sửa" class="btn btn-warning btn-sm"></td>
                         <td ><input type="button" onclick="Delete('5');" value="Xóa" class="btn btn-danger btn-sm"></td>
                      </tr>
                      <tr>
                         <td><input type="checkbox"></td>
                         <td >Sữa Tắm</td>
                         <td > <input type="button" onclick="Edit('6');" value="Sửa" class="btn btn-warning btn-sm"></td>
                         <td ><input type="button" onclick="Delete('6');" value="Xóa" class="btn btn-danger btn-sm"></td>
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
@endsection