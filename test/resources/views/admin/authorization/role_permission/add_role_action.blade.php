@extends('admin_layout')
@section('admin_content')
<div id="content-wrapper">
    <div class="container-fluid">
       <!-- Breadcrumbs-->
       <ol class="breadcrumb">
          <li class="breadcrumb-item">
             <a href="#">Quản lý</a>
          </li>
          <li class="breadcrumb-item active">Vai trò</li>
       </ol>
       <!-- /form -->
       <form method="post" action="" enctype="multipart/form-data">
          <label class="col-md-12 control-label">Vai trò: Nhân viên</label> 
          <input type="hidden" value="2" name="id">
          <div class="form-group row">
             <div class="ol-md-9 col-lg-6 form-group">
                <select name="action" id="action" class="form-control">
                   <option value="list_product">Hiển thị danh sách sản phẩm</option>
                   <option value="edit_product">Sửa sản phẩm</option>
                   <option value="add_product">Thêm sản phẩm</option>
                   <option value="delete_product">Xóa sản phẩm</option>
                   <option value="list_staff">Hiển thị danh sách nhân viên</option>
                   <option value="edit_staff">Sửa nhân viên</option>
                   <option value="add_staff">Thêm nhân viên</option>
                   <option value="delete_staff">Xóa nhân viên</option>
                </select>
             </div>
             
          </div>
          <div class="form-action">
             <input type="submit" class="btn btn-primary btn-sm" value="Lưu" name="save">
          </div>
       </form>
       <!-- /form -->
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