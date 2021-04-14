<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <title>Tổng quan</title>
      <!-- Create favicon -->
      <link rel="shortcut icon" type="image/x-icon" href="{{asset('backend/images/logo.jpg')}}" />
      <!-- Custom fonts for this template-->
      <link href="{{asset('backend/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
      <!-- Page level plugin CSS-->
      <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">
      <!-- Custom styles for this template-->
      <link href="{{asset('backend/css/sb-admin.css')}}" rel="stylesheet">
      <link href="{{asset('backend/css/admin.css')}}" rel="stylesheet">
   </head>
<body id="page-top">
   @include('admin.nav-bar')

   <div id="wrapper">

      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
         <li class="nav-item active">
            <a class="nav-link" href="{{ URL::TO('admin-dashboard') }}"><i class="fas fa-fw fa-tachometer-alt"></i> <span>Tổng quan</span></a>
         </li>
         <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="fas fa-shopping-cart"></i> <span>Đơn hàng</span></a>
            <div class="dropdown-menu" aria-labelledby="">
               <a class="dropdown-item" href="{{route('admin.order.index')}}">Danh sách</a>
               <a class="dropdown-item" href="{{route('admin.order.create')}}">Thêm</a>
            </div>
         </li>
         <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="fab fa-product-hunt"></i> <span>Sản phẩm</span></a>
            <div class="dropdown-menu" aria-labelledby="">
               <a class="dropdown-item" href="{{ route('admin.product.index') }}">Danh sách</a>
               <a class="dropdown-item" href="{{ route('admin.product.create') }}">Thêm</a>
               <a class="dropdown-item" href="">Chỉnh sửa</a>
            </div>
         </li>
         <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="fas fa-comments"></i> <span>Comment</span></a>
            <div class="dropdown-menu" aria-labelledby="">
               <a class="dropdown-item" href="{{URL::to('comment-list')}}">Danh sách</a>
            </div>
         </li>

         <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="far fa-image"></i> <span>Hình ảnh</span></a>
            <div class="dropdown-menu" aria-labelledby="">
               <a class="dropdown-item" href="{{URL::to('image-list')}}">Danh sách</a>
            </div>
         </li>
         <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="fas fa-user-alt"></i> <span>Khách hàng</span></a>
            <div class="dropdown-menu" aria-labelledby="">
               <a class="dropdown-item" href="{{URL::to('customer-list')}}">Danh sách</a>
               <a class="dropdown-item" href="{{URL::tO('customer-add')}}">Thêm</a>
               <a class="dropdown-item" href="{{URL::tO('customer-edit')}}">Chỉnh sửa</a>
            </div>
         </li>
         <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="fas fa-folder"></i> <span>Danh mục</span></a>
            <div class="dropdown-menu" aria-labelledby="">
               <a class="dropdown-item" href="{{route('admin.category.index')}}">Danh sách</a>
               <a class="dropdown-item" href="{{route('admin.category.create')}}">Thêm</a>
               <a class="dropdown-item" href="{{URL::to('category-edit')}}">Chỉnh sửa</a>
            </div>
         </li>
         <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="fas fa-folder"></i> <span>Brand</span></a>
            <div class="dropdown-menu" aria-labelledby="">
               <a class="dropdown-item" href="{{route('admin.brand.index')}}">Danh sách</a>
               <a class="dropdown-item" href="{{route('admin.brand.create')}}">Thêm</a>
               <a class="dropdown-item" href="{{URL::to('brand-edit')}}">Chỉnh sửa</a>
            </div>
         </li>
         <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="fas fa-percentage"></i> <span>Khuyến mãi</span></a>
            <div class="dropdown-menu" aria-labelledby="">
               <a class="dropdown-item" href="{{URL::to('promotion-list')}}">Danh sách</a>
               <a class="dropdown-item" href="{{URL::to('promotion-add')}}">Thêm</a>
               <a class="dropdown-item" href="{{URL::to('promotion-edit')}}">Chỉnh sửa</a>
            </div>
         </li>
         <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="fas fa-shipping-fast"></i> <span>Phí giao hàng</span></a>
            <div class="dropdown-menu" aria-labelledby="">
               <a class="dropdown-item" href="{{URL::to('transport-list')}}">Danh sách</a>
               <a class="dropdown-item" href="{{URL::to('transport-add')}}">Thêm</a>
               <a class="dropdown-item" href="{{URL::to('transport-edit')}}">Chỉnh sửa</a>
            </div>
         </li>
         <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="fas fa-users"></i> <span>Nhân viên</span></a>
            <div class="dropdown-menu" aria-labelledby="">
               <a class="dropdown-item" href="{{URL::to('staff-list')}}">Danh sách</a>
               <a class="dropdown-item" href="{{URL::to('staff-add')}}">Thêm</a>
               <a class="dropdown-item" href="{{URL::to('staff-edit')}}">Chỉnh sửa</a>
            </div>
         </li>
         <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="fas fa-user-shield"></i> <span>Phân quyền</span></a>
            <div class="dropdown-menu" aria-labelledby="">
               <a class="dropdown-item" href="{{URL::to('permission-roles-list')}}">Roles List</a>
               <a class="dropdown-item" href="{{URL::to('permission-roles-add')}}">Roles Add</a>
               <a class="dropdown-item" href="{{URL::to('permission-roles-edit')}}">Roles Edit</a>
               <a class="dropdown-item" href="{{URL::to('permission-actions-list')}}">Actions List</a>
               <a class="dropdown-item" href="{{URL::to('permission-actions-edit')}}">Actions Edit</a>
               <a class="dropdown-item" href="{{URL::to('permission-role_action-list')}}">Role-Action-List</a>
               <a class="dropdown-item" href="{{URL::to('permission-role_action-add')}}">Role-Action-Add</a>


            </div>
         </li>
         <li class="nav-item">
            <a class="nav-link" href="{{URL::to('order_status-list')}}"><i class="fas fa-star-half-alt"></i> <span>Trạng thái đơn hàng</span></a>
         </li>
         <li class="nav-item">
            <a class="nav-link" href="{{URL::to('order_status-edit')}}"><i class="fas fa-star-half-alt"></i> <span>Trạng thái đơn hàng (Sửa)</span></a>
         </li>
         <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="fas fa-file-alt"></i> <span>News letter</span></a>
            <div class="dropdown-menu" aria-labelledby="">
               <a class="dropdown-item" href="{{URL::to('newsletter-list')}}">Danh sách</a>
               <a class="dropdown-item" href="{{URL::to('newsletter-send')}}">Gởi mail</a>
            </div>
         </li>
      </ul>

      @yield('admin_content')


</div>
<!-- /#wrapper -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top bg-primary" href="#page-top">
   <i class="fas fa-angle-up"></i>
   </a>
   <!-- Logout Modal-->
   <div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Bạn muốn thoát?</h5>
               <button class="close" type="button" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">×</span>
               </button>
            </div>
            <div class="modal-footer">
               <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
               <a class="btn btn-primary" href="login.html">Thoát</a>
            </div>
         </div>
      </div>
   </div>
 <!-- Bootstrap core JavaScript-->
 <script src="{{asset('backend/vendor/jquery/jquery.min.js')}}"></script>
 <script src="{{asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
 <!-- Core plugin JavaScript-->
 <script src="{{asset('backend/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
 <!-- Page level plugin JavaScript-->
 <script src="{{asset('backend/vendor/datatables/jquery.dataTables.js')}}"></script>
 <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.js')}}"></script>
 {{-- DATA TABLE  --}}
 <script>
   $(function () {
   //   $("#example1").DataTable();
     $('#dataTable').DataTable({
       "paging": true,
       "lengthChange": true,
       "searching": true,
       "ordering": true,
       "info": true,
       "autoWidth": false,
     });
   });
 </script>
 {{-- CKEDITOR  --}}
 {{-- <script src="https://cdn.ckeditor.com/ckeditor5/27.0.0/classic/ckeditor.js"></script>
 <script>
   ClassicEditor
       .create( document.querySelector( '#editor' ) )
       .catch( error => {
           console.error( error );
       } );
</script> --}}

 <!-- Custom scripts for all pages-->
 <script src="{{asset('backend/js/sb-admin.min.js')}}"></script>
 <!-- Demo scripts for this page-->
 <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
 <script src="{{asset('backend/js/admin.js')}}"></script>
</body>
</html>
