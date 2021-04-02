@extends('admin_layout')
@section('admin_content')
<div id="content-wrapper">
    <div class="container-fluid">
       <!-- Breadcrumbs-->
       <ol class="breadcrumb">
          <li class="breadcrumb-item">
             <a href="#">Quản lý</a>
          </li>
          <li class="breadcrumb-item active">Nhân viên</li>
       </ol>
       <!-- /form -->
       <form method="post" action="" enctype="multipart/form-data">
          <div class="form-group row">
             <label class="col-md-12 control-label" for="fullname">Họ Và Tên</label>  
             <div class="col-md-9 col-lg-6">
                <input name="fullname" id="fullname" type="text" value="" class="form-control">                        
             </div>
          </div>
          <div class="form-group row">
             <label class="col-md-12 control-label" for="username">Tên Đăng Nhập</label>  
             <div class="col-md-9 col-lg-6">                           
                <input name="username" id="username" type="text" value="" class="form-control">                        
             </div>
          </div>
          <div class="form-group row">
             <label class="col-md-12 control-label" for="password">Mật Khẩu</label>  
             <div class="col-md-9 col-lg-6">                           
                <input name="password" id="password" type="password" value="" class="form-control">                      
             </div>
          </div>
          <div class="form-group row">
             <label class="col-md-12 control-label" for="mobile">Số Điện Thoại</label>  
             <div class="col-md-9 col-lg-6">                           
                <input name="mobile" id="mobile" type="text" value="" class="form-control">                       
             </div>
          </div>
          <div class="form-group row">
             <label class="col-md-12 control-label" for="email">Email</label>  
             <div class="col-md-9 col-lg-6">                           
                <input name="email" id="email" type="text" value="" class="form-control">                      
             </div>
          </div>
          <div class="form-group row">
             <label class="col-md-12 control-label" for="role">Vai trò</label>  
             <div class="col-md-9 col-lg-6">
                <select class="form-control">
                   <option value="1">Quản trị</option>
                   <option value="2">Nhân viên</option>
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