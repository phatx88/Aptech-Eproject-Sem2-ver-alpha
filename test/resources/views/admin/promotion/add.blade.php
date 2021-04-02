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
       <!-- /form -->
       <form method="post" action="" enctype="multipart/form-data">
          <div class="form-group">
             <label class="col-md-9 col-lg-6 control-label" for="name">Tên</label>  
             <div class="col-md-9 col-lg-6">
                <input name="name" id="name" type="text" value="" class="form-control">                      
             </div>
          </div>
          <div class="form-group">
             <label class="col-md-9 col-lg-6 control-label" for="from">Từ ngày</label>  
             <div class="col-md-9 col-lg-6">
                <input name="from" type="date" id="from" value="" class="form-control">                      
             </div>
          </div>
          <div class="form-group">
             <label class="col-md-9 col-lg-6 control-label" for="to">Đến ngày</label>  
             <div class="col-md-9 col-lg-6">
                <input name="to" type="date" id="to" value="" class="form-control">                       
             </div>
          </div>
          <div class="form-group">
             <label class="col-md-9 col-lg-6 control-label" for="active">Có hiệu lực</label>  
             <div class="col-md-9 col-lg-6">
                <input name="active" type="checkbox" id="active" value="1">                      
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