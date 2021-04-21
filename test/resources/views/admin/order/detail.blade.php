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
       </ol>
       <!-- /.row -->
      
       <div class="row">
           <div class="col-sm-12 ">
               <label for="name" class="control-label">Đơn hàng: #112</label>  
               <input type="hidden" name="id" value="112">
           </div>
       </div>
      <div class="row ">
           <div class="col-sm-4 col-lg-2">
               <label>Tên khách hàng:</label>  
           </div>
           <div class="col-sm-8 col-lg-10"> 
               <span>Nguyễn Văn A</span>							
           </div>
       </div>
       
       <div class="row">
           <div class="col-sm-4 col-lg-2">
               <label>Điện thoại:</label>  
           </div>
           <div class="col-sm-8 col-lg-10"> 
               <span>0932538468</span>							
           </div>
       </div>
       
       <div class="row">
           <div class="col-sm-4 col-lg-2">
               <label>Email:</label>  
           </div>
           <div class="col-sm-8 col-lg-10"> 
               <span>nguyenvana@gmail.com</span>							
           </div>
       </div>
       
       <div class="row">
           <div class="col-sm-4 col-lg-2">
               <label>Trạng thái:</label>  
           </div>
           <div class="col-sm-8 col-lg-10"> 
               <span>Đang xử lý</span>							
           </div>
       </div>
       
       <div class="row">
           <div class="col-sm-4 col-lg-2">
               <label>Ngày đặt hàng:</label>  
           </div>
           <div class="col-sm-8 col-lg-10"> 
               <span>2019-03-10 15:35:59</span>							
           </div>
       </div>
       
       <div class="row">
           <div class="col-sm-4 col-lg-2">
               <label>Hình thức giao hàng:</label>  
           </div>
           <div class="col-sm-8 col-lg-10"> 
               <span>Giao Hàng Tiêu Chuẩn: Từ 2 đến 3 ngày</span>							
           </div>
       </div>
       
       <div class="row">
           <div class="col-sm-4 col-lg-2">
               <label>Phí giao hàng:</label>  
           </div>
           <div class="col-sm-8 col-lg-10"> 
               <span>0 đ</span>							
           </div>
       </div>
       
       <div class="row">
           <div class="col-sm-4 col-lg-2">
               <label>Tạm tính:</label>  
           </div>
           <div class="col-sm-8 col-lg-10"> 
               <span>2,000,000 đ</span>							
           </div>
       </div>
       
       <div class="row">
           <div class="col-sm-4 col-lg-2">
               <label>Tổng cộng:</label>  
           </div>
           <div class="col-sm-8 col-lg-10"> 
               <span>2,000,000 đ</span>							
           </div>
       </div>
       
       <div class="row">
           <div class="col-sm-4 col-lg-2">
               <label>Địa chỉ giao hàng:</label>  
           </div>
           <div class="col-sm-8 col-lg-10"> 
               <span>278 Hòa Bình, Hiệp Tân, Tân Phú, TP.HCM</span>							
           </div>
       </div>
       
       <div class="row">
           <div class="col-sm-4 col-lg-2">
               <label>Nhân viên phụ trách:</label>  
           </div>
           <div class="col-sm-8 col-lg-10"> 
               <span>Nguyễn Hữu Lộc</span>							
           </div>
       </div>
       <label class="control-label">Sản phẩm</label>  
       <div class="card mb-3">
             <div class="card-body">
                <div class="table-responsive">
                   <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                       <thead>
                          <tr>
                             <th>Mã sản phẩm</th>
                             <th>Tên sản phẩm</th>
                             <th>Hình ảnh</th>
                             <th>Giá</th>
                             <th>Số lượng</th>
                          </tr>
                       </thead>
                       <tbody>
                          <tr>
                             <td >#7452</td>
                             <td>Kem Chống Nắng SunDefense 80ml</td>
                             <td><img src="../../images/kemChongNangSunDefense80ml.jpg"></td>
                             <td>1,350,00 đ <br><del>1,500,00 đ </del><br><del>15%</del></td>
                             <td>2</td>
                          </tr>
                          <tr>
                             <td >#7453</td>
                             <td>Kem Dưỡng Trắng Da UV30 15g</td>
                             <td><img src="../../images/kemDuongTrangDaUV3015g.jpg"></td>
                             <td>1,350,00 đ</td>
                             <td>3</td>
                          </tr>
                       </tbody>
                   </table>
               </div>
           </div>
       </div>
      <!-- /.row -->
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
</div>
<!-- /#wrapper -->
@endsection