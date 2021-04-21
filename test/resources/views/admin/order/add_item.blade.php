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
       <form class="spacing" method="post" action="" enctype="multipart/form-data">
           <div class="row">
               <div class="col-sm-12 ">
                   <label for="name" class="control-label">Đơn hàng: #112</label>  
                   <input type="hidden" name="id" value="112">
               </div>
           </div>
           <div class="card mb-3">
                 <div class="card-body">
                    <div class="table-responsive">
                       <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                           <thead>
                              <tr>
                                  <th><input type="checkbox" onclick="checkAll(this)"></th>
                                 <th>Mã sản phẩm</th>
                                 <th>Tên sản phẩm</th>
                                 <th>Hình ảnh</th>
                                 <th>Giá</th>
                                 <th>Số lượng</th>
                                 <th>Thành tiền</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                  <td><input type="checkbox"></td>
                                 <td >#7452</td>
                                 <td>Kem Chống Nắng SunDefense 80ml</td>
                                 <td><img src="../../images/kemChongNangSunDefense80ml.jpg"></td>
                                 <td>1,350,000 đ <br><del>1,500,000 đ </del><br><del>15%</del></td>
                                 <td><input type="number" value="2"></td>
                                 <td><span>2,750,000 đ</span></td>
                                 
                              </tr>
                              <tr>
                                  <td><input type="checkbox"></td>
                                 <td >#7453</td>
                                 <td>Kem Dưỡng Trắng Da UV30 15g</td>
                                 <td><img src="../../images/kemDuongTrangDaUV3015g.jpg"></td>
                                 <td>1,350,000 đ</td>
                                 <td><input type="number" value="3"></td>
                                 <td><span>4,100,000 đ</span></td>
                              </tr>
                           </tbody>
                       </table>
                   </div>
               </div>
           </div>
           
           <div class="form-action">
               <input type="submit" class="btn btn-primary btn-sm" value="Thêm" name="edit">
           </div>
           <br>
       </form>
       <!-- /.row -->
       <!-- /.row -->
       
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