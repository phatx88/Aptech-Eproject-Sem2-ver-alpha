@extends('admin_layout')
@section('admin_content')
<div id="content-wrapper">
    <div class="container-fluid">
       <!-- Breadcrumbs-->
       <ol class="breadcrumb">
          <li class="breadcrumb-item">
             <a href="#">Quản lý</a>
          </li>
          <li class="breadcrumb-item active">Khuyến mại</li>
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
                         <th >Từ ngày</th>
                         <th >Đến ngày</th>
                         <th >
                         </th>
                         <th >
                         </th>
                         <th >
                         </th>
                      </tr>
                   </thead>
                   <tbody>
                      <tr>
                         <td><input type="checkbox"></td>
                         <td >Giáng Sinh Tưng Bừng Giảm Giá</td>
                         <td >2017-11-01</td>
                         <td >2017-12-31</td>
                         <td >Có hiệu lực</td>
                         <td > <input type="button" onclick="Edit('1');" value="Sửa" class="btn btn-warning btn-sm"></td>
                         <td ><input type="button" onclick="Delete('1');" value="Xóa" class="btn btn-danger btn-sm"></td>
                      </tr>
                      <tr>
                         <td><input type="checkbox"></td>
                         <td >Mừng Ngày Phụ Nữ Việt Nam 20/10</td>
                         <td >2017-10-15</td>
                         <td >2017-10-30</td>
                         <td >Bị vô hiệu</td>
                         <td > <input type="button" onclick="Edit('3');" value="Sửa" class="btn btn-warning btn-sm"></td>
                         <td ><input type="button" onclick="Delete('3');" value="Xóa" class="btn btn-danger btn-sm"></td>
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