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
          <li class="breadcrumb-item active">Thêm</li>
       </ol>
       <!-- /.row -->
       <form class="spacing" method="post" action="" enctype="multipart/form-data">
           <div class="row ">
         <div class="col-sm-4 col-lg-2">
            <label>Tên khách hàng:</label>  
         </div>
         <div class="col-sm-8 col-lg-6"> 
            <select class="form-control">
               <option value="">Chọn khách hàng</option>
               <option value="a@gmail.com">Nguyễn Văn A</option>
               <option value="b@gmail.com">Nguyễn Văn B</option>
            </select>                  
         </div>
      </div>
      
      <div class="row">
         <div class="col-sm-4 col-lg-2 ">
            <label>Trạng thái:</label>  
         </div>
         <div class="col-sm-8 col-lg-6"> 
            <select name="status" class="form-control">
                <option value="1" selected>Đã đặt hàng</option>
                <option value="2">Đã xác nhận đơn hàng</option>
                <option value="3">Hoàn tất đóng gói</option>
                <option value="4">Đang giao Hàng</option>
                <option value="5">Đã giao hàng</option>
                <option value="6">Đơn hàng đã huy</option>
              </select>
         </div>
      </div>
      
      <div class="row">
         <div class="col-sm-4 col-lg-2 ">
            <label>Người nhận</label>  
         </div>
         <div class="col-sm-8 col-lg-6"> 
            <input type="text" name="" value="Nguyễn Văn Én" class="form-control">                    
         </div>
      </div>
      <div class="row">
         <div class="col-sm-4 col-lg-2 ">
            <label>Số điện thoại người nhận</label>  
         </div>
         <div class="col-sm-8 col-lg-6"> 
            <input type="text" name="mobile" value="0932538468" class="form-control">                    
         </div>
      </div>
      
      <div class="row">
         <div class="col-sm-4 col-lg-2 ">
            <label>Hình thức thanh toán</label>  
         </div>
         <div class="col-sm-8 col-lg-6"> 
            <select name="transport" class="form-control">
                <option selected value="0">COD</option>
                <option value="1">Bank</option>
              </select>
         </div>
      </div>
      
      <div class="row">
         <div class="col-sm-4 col-lg-2">
            <label>Địa chỉ giao hàng</label>  
         </div>
         <div class="col-sm-8 col-lg-6"> 
            <div class="row">
               <div class="col-sm-4">
                        <select name="city" class="form-control">
                           <option value="">Tỉnh / thành phố</option>
                           <option value="hcm">Hồ Chí Minh</option>
                           <option value="hn">Hà Nội</option>
                       </select>
                     </div>
                    <div class="col-sm-4">
                        <select name="district" class="form-control">
                            <option value="">Quận / huyện</option>
                            <option value="q1">Quận 1</option>
                            <option value="q2">Quận 2</option>
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <select name="ward" class="form-control">
                            <option value="">Phường / xã</option>
                            <option value="p1">Phường 1</option>
                            <option value="p2">Phường 2</option>
                        </select>
                    </div>
            </div>                     
         </div>
         
      </div>

      <div class="row">
         <div class="col-sm-4 col-lg-2 ">
            <label>Ngày giao hàng</label>  
         </div>
         <div class="col-sm-8 col-lg-6"> 
            <input type="date" name="" value="2019-07-17" class="form-control">
         </div>
      </div>
      
      <div class="row">
         <div class="col-sm-4 col-lg-2 ">
            <label>Nhân viên phụ trách</label>  
         </div>
         <div class="col-sm-8 col-lg-6"> 
            <select name="staff" class="form-control">
             <option selected value="6">Nguyễn Hữu Lộc</option>
             <option value="7">Nguyễn Thị Lệ</option>
           </select>                
         </div>
      </div>
           
           <div class="form-action">
               <input type="submit" class="btn btn-primary btn-sm" value="Lưu" name="save">
           </div>
           <br>
       </form>
       <!-- /.row -->
       <!-- /.row -->
       
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
   <!-- Sticky Footer -->
   @include('admin.footer')
</div>
@endsection