@extends('admin_layout')
@section('admin_content')
<div id="content-wrapper">
            <div class="container-fluid">
               <!-- Breadcrumbs-->
               <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                     <a href="#">Quản lý</a>
                  </li>
                  <li class="breadcrumb-item active">Khách hàng</li>
               </ol>
               <!-- /form -->
               <form method="post" action="" enctype="multipart/form-data">
                  <div class="form-group row">
                     <label class="col-md-12 control-label" for="fullname">Tên</label>
                     <div class="col-md-9 col-lg-6">
                        <input type="hidden" name="id" value="1" class="form-control">
                        <input name="fullname" id="fullname" type="text" value="" class="form-control">
                     </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-md-12 control-label" for="email">Email</label>
                     <div class="col-md-9 col-lg-6">
                        <input name="email" id="email" type="text" value="" class="form-control">
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
                     <label class="col-md-12 control-label" for="">Địa chỉ</label>
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
                  </div >
                  <div class="form-group row">
                    <div class="col-md-9 col-lg-6">
                        <input type="text" class="form-control" placeholder="Số nhà, đường" name="housenumumber_street">
                    </div>
                  </div>
                  <div class="form-group row">
                     <label class="col-md-12 control-label" for="mobile">Tên người nhận</label>
                     <div class="col-md-9 col-lg-6">
                        <input name="shipping_name" id="shipping_name" type="text" value="" class="form-control">
                     </div>
                  </div>

                  <div class="form-group row">
                     <label class="col-md-12 control-label" for="mobile">Số điện thoại người nhận</label>
                     <div class="col-md-9 col-lg-6">
                        <input name="shipping_mobile" id="shipping_mobile" type="tel" value="" class="form-control">
                     </div>
                  </div>

                  <div class="form-group row">
                     <label class="col-md-12 control-label" for="mobile">Đã kích hoạt</label>
                     <div class="col-md-9 col-lg-6">
                        <input name="active" id="active" type="checkbox" value="1" checked>
                     </div>
                  </div>

                  <div class="form-action">
                     <input type="submit" class="btn btn-primary btn-sm" value="Cập nhật" name="update">
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
