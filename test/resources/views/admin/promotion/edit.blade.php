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
                <input name="id" type="hidden" value="1" class="form-control">
                <input name="name" id="name" type="text" value="Giáng Sinh Tưng Bừng Giảm Giá" class="form-control">                       
             </div>
          </div>
          <div class="form-group">
             <label class="col-md-9 col-lg-6 control-label" for="from">Từ ngày</label>  
             <div class="col-md-9 col-lg-6">
                <input name="from" type="date" id="from" value="2017-11-01" class="form-control">                        
             </div>
          </div>
          <div class="form-group">
             <label class="col-md-9 col-lg-6 control-label" for="to">Đến ngày</label>  
             <div class="col-md-9 col-lg-6">
                <input name="to" type="date" id="to" value="2017-12-31" class="form-control">                      
             </div>
          </div>
           <div class="form-group">
             <label class="col-md-9 col-lg-6 control-label" for="active">Có hiệu lực</label>  
             <div class="col-md-9 col-lg-6">
                <input name="active" type="checkbox" id="active" value="1">                      
             </div>
          </div>
          <label class="control-label">Sản phẩm khuyến mại</label>
          <div class="form-group">
             <button class="btn btn-primary btn-sm">Thêm sản phẩm</button> 
             <input type="submit" class="btn btn-danger btn-sm" value="Xóa sản phẩm" name="delete"> 
          </div>
          <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
             <thead>
                <tr>
                   <th><input type="checkbox" onclick="checkAll(this)"></th>
                   <th >Mã sản phẩm</th>
                   <th >Tên</th>
                   <th >Hình</th>
                   <th >Tỉ lệ giảm giá</th>
                   <th></th>
                </tr>
             </thead>
             <tbody>
                <tr>
                   <td><input type="checkbox"></td>
                   <td >124</td>
                   <td >Kem làm trắng da 5 trong 1 Beaumore Secret Whitening Cream</td>
                   <td ><img class="promotion-detail-image" src="../../images/kemDuongTrangDaUV3015g.jpg"></td>
                   <td >15%</td>
                   <td ><input type="button" onclick="Delete('1');" value="Xóa" class="btn btn-danger btn-sm"></td>
                </tr>
                <tr>
                   <td><input type="checkbox"></td>
                   <td >125</td>
                   <td >Kem làm trắng da 6 trong 1 Beaumore Secret Whitening Cream</td>
                   <td ><img class="promotion-detail-image" src="../../images/kemDuongTrangDaUV3015g.jpg"></td>
                   <td >20%</td>
                   <td ><input type="button" onclick="Delete('1');" value="Xóa" class="btn btn-danger btn-sm"></td>
                </tr>
                <tr>
                   <td><input type="checkbox"></td>
                   <td >126</td>
                   <td >Kem làm trắng da 7 trong 1 Beaumore Secret Whitening Cream</td>
                   <td ><img class="promotion-detail-image" src="../../images/kemDuongTrangDaUV3015g.jpg"></td>
                   <td >25%</td>
                   <td ><input type="button" onclick="Delete('1');" value="Xóa" class="btn btn-danger btn-sm"></td>
                </tr>
             </tbody>
          </table>
          <div class="form-action">
             <input type="submit" class="btn btn-primary btn-sm" value="Cập nhật" name="update">
          </div>
          <br>
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