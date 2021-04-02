@extends('admin_layout')
@section('admin_content')
<div id="content-wrapper">
         <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
               <li class="breadcrumb-item">
                  <a href="#">Quản lý</a>
               </li>
               <li class="breadcrumb-item active">Sản phẩm</li>
            </ol>
            <!-- /form -->
            <form method="post" action="" enctype="multipart/form-data">
               <div class="row form-group">
                  <label class="col-md-12 control-label" for="name">Tên </label>  
                  <div class="col-md-9 col-lg-6">
                     <input type="hidden" name="id" value="25" class="form-control">
                     <input name="name" id="name" type="text" value="Kem trị mụn nghệ Nhật Beaumore Pure Turmeric Cream (Mới)- 20g " class="form-control">                       
                  </div>
               </div>
               
               <div class="form-group row">
                  <label class="col-md-12 control-label" for="retail-price">Giá bán lẻ </label>  
                  <div class="col-md-9 col-lg-6">
                     <input name="retail-price" id="retail-price" type="text" value="239000" class="form-control">
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-md-12 control-label" for="inventory-number">Lượng tồn</label>  
                  <div class="col-md-9 col-lg-6">
                     <input name="inventory-number" id="inventory-number" type="text" value="20" class="form-control">			
                  </div>
               </div>
               
               <div class="form-group row">
                  <label class="col-md-12 control-label" for="category">Danh mục</label>  
                  <div class="col-md-9 col-lg-6">
                     <select name="category" id="category" class="form-control">
                        <option value="Kem Chống Nắng">Kem Chống Nắng</option>
                        <option value="Kem Dưỡng Da">Kem Dưỡng Da</option>
                        <option selected value="Kem Trị Mụn">Kem Trị Mụn</option>
                        <option value="Kem Trị Thâm Nám">Kem Trị Thâm Nám</option>
                        <option value="Sữa Rửa Mặt">Sữa Rửa Mặt</option>
                        <option value="Sữa Tắm">Sữa Tắm</option>
                     </select>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-md-12 control-label">Ngày tạo </label>  
                  <div class="col-md-9 col-lg-6">
                     2017-10-16 14:22:00
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-md-12 control-label">Nổi bật</label>  
                  <div class="col-md-9 col-lg-6">
                     <input type="checkbox" value="1">
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col-md-12">
                     <img src="../../images/bodyLotionMakeup.jpg" alt="">
                  </div>
                  <div class="col-md-9 col-lg-6">
                     <input type="file" name="image" id="image">              
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-md-12 control-label" for="description">Mô tả</label>  
                  <div class="col-md-12">
                     <textarea name="description" id="description" rows="10" cols="80">
                           <p>Giới Thiệu Dòng Sản Phẩm Son Môi WODWOD

                           Son môi WODWOD gồm 5 màu để bạn lưa chon.</p>

                           <p>Là một trong những mẫu son môi chất lượng an toàn với khả năng dưỡng môi kết hợp với khả năng trang điểm đôi môi mang tới cho bạn gái một đôi môi xinh tươi đáng yêu hơn bao giờ hết
                           </p>
                           <p>Không chỉ giúp cho khách hàng của mình có được một đôi môi đẹp mà son môi WODWOD còn cung cấp cho khách hàng nhiều màu môi để lựa chọn phù hợp với tùy từng sở thích riêng của mỗi người.</p>
                        </textarea>
                  </div>
                  
               </div>
               <div class="form-action">
                  <input type="submit" class="btn btn-primary btn-sm" value="Cập nhật" name="update">
               </div>
            </form>
            <script type="text/javascript" src="../../vendor/ckeditor/ckeditor.js"></script>
            <script>CKEDITOR.replace('description');</script>
            <!-- /form -->
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
      @endsection