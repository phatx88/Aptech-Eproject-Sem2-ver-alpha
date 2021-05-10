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
      {{-- Notif CSS  --}}
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
      {{-- Sweet Alert  --}}
      <link rel="stylesheet" href="{{ asset('frontend/css/sweetalert.css') }}">
      {{-- introJS  --}}
      <link rel="stylesheet" href="https://unpkg.com/intro.js/minified/introjs.min.css">
      {{-- Full Calendar  --}}
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
      <!-- Custom styles for this template-->
      <link href="{{asset('backend/css/sb-admin.css')}}" rel="stylesheet">
      <link href="{{asset('backend/css/admin.css')}}" rel="stylesheet">
   </head>
<body id="page-top">
   @include('admin.nav-bar')

   <div id="wrapper">

      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
         <li class="nav-item logo-wrapper" style="background-image: url({{ asset('frontend/images/image_2.jpg') }})">
                @if (Auth::check() && isset(Auth::user()->profile_pic))
                   <img src="{{ asset('frontend/images/profile/' . Auth::user()->profile_pic) }}" alt="Avatar" class="logo">
                @else
                   <img src="{{ asset('frontend/images/profile/avatar.jpg') }}" alt="Avatar" class="logo">
                @endif                         
         </li>
         <li class="nav-item {{ Request::segment(2) == 'dashboard' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.dashboard.index') }}"><i class="fas fa-fw fa-tachometer-alt"></i> <span>Dash Board</span></a>
         </li>
         <li class="nav-item dropdown {{ Request::segment(2) == 'order' ? 'active' : '' }}">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="fas fa-shopping-cart"></i> <span>Orders</span></a>
            <div class="dropdown-menu" aria-labelledby="">
               <a class="dropdown-item" href="{{route('admin.order.index')}}"><i class="fas fa-list"></i> List</a>
               <a class="dropdown-item" href="{{route('admin.order.create')}}"><i class="fas fa-plus"></i> Add</a>
               <a class="dropdown-item" href="{{url('admin/order/trash')}}"><i class="fas fa-recycle"></i>  Restore</a>
            </div>
         </li>
         <li class="nav-item dropdown {{ Request::segment(2) == 'product' ? 'active' : '' }}">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="fab fa-product-hunt"></i> <span>Products</span></a>
            <div class="dropdown-menu" aria-labelledby="">
               <a class="dropdown-item" href="{{ route('admin.product.index') }}"><i class="fas fa-list"></i> List</a>
               <a class="dropdown-item" href="{{ route('admin.product.create') }}"><i class="fas fa-plus"></i> Add</a>
               <a class="dropdown-item" href="{{route('admin.category.index')}}"><i class="fas fa-folder"></i> Category</a>
               <a class="dropdown-item" href="{{route('admin.brand.index')}}"><i class="fas fa-folder"></i>  Brand</a>
               <a class="dropdown-item" href="{{url('admin/product/trash')}}"><i class="fas fa-recycle"></i>  Restore</a>
            </div>
         </li>
         <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="fas fa-gift"></i> <span>Coupons</span></a>
            <div class="dropdown-menu" aria-labelledby="">
               <a class="dropdown-item" href="{{route('admin.coupon.index')}}">List</a>
               <a class="dropdown-item" href="{{route('admin.coupon.create')}}">Add</a>
               <a class="dropdown-item" href="{{URL::to('brand-edit')}}">Edit</a>
            </div>
         </li>
         <li class="nav-item dropdown {{ Request::segment(2) == 'image' ? 'active' : '' }}">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="far fa-image"></i> <span>Images</span></a>
            <div class="dropdown-menu" aria-labelledby="">
               <a class="dropdown-item" href="{{URL::to('image-list')}}">List</a>
            </div>
         </li>
         <li class="nav-item dropdown {{ Request::segment(2) == 'staff' ? 'active' : '' }}">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="fas fa-users"></i> <span>Staff</span></a>
            <div class="dropdown-menu" aria-labelledby="">
               <a class="dropdown-item" href="{{route('admin.staff.index')}}">List</a>
               <a class="dropdown-item" href="{{URL::to('staff-add')}}">Add</a>
               <a class="dropdown-item" href="{{URL::to('staff-edit')}}">Edit</a>
            </div>
         </li>
         <li class="nav-item dropdown {{ Request::segment(2) == 'customer' ? 'active' : '' }}">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="fas fa-user-alt"></i> <span>Users</span></a>
            <div class="dropdown-menu" aria-labelledby="">
               <a class="dropdown-item" href="{{route('admin.user.index')}}">List</a>
               {{-- <a class="dropdown-item" href="{{route('admin.user.add')}}">Add</a> --}}
               <a class="dropdown-item" href="{{URL::tO('customer-edit')}}">Edit</a>
            </div>
         </li>
         <li class="nav-item dropdown {{ Request::segment(2) == 'blog' ? 'active' : '' }}">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="fas fa-blog"></i> <span>Blog</span></a>
            <div class="dropdown-menu" aria-labelledby="">
               <a class="dropdown-item" href="{{ route('admin.blog.index') }}">List</a>
               <a class="dropdown-item" href="{{ route('admin.blog.create') }}">Add</a>
               {{-- <a class="dropdown-item" href="{{URL::tO('customer-edit')}}">Edit</a> --}}
            </div>
         </li>
         
         
         <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="fas fa-shipping-fast"></i> <span>Shipping Fee</span></a>
            <div class="dropdown-menu" aria-labelledby="">
               <a class="dropdown-item" href="{{URL::to('transport-list')}}">List</a>
               <a class="dropdown-item" href="{{URL::to('transport-add')}}">Add</a>
               <a class="dropdown-item" href="{{URL::to('transport-edit')}}">Edit</a>
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
         <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id=""><i class="fas fa-file-alt"></i> <span>News letter</span></a>
            <div class="dropdown-menu" aria-labelledby="">
               <a class="dropdown-item" href="{{URL::to('newsletter-list')}}">List</a>
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

 <!-- Bootstrap core JavaScript-->
 {{-- <script src="{{asset('backend/vendor/jquery/jquery.min.js')}}"></script> --}}
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
 <script src="{{asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
 <!-- Core plugin JavaScript-->
 <script src="{{asset('backend/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
 <!-- Page level plugin JavaScript-->
 <script src="{{asset('backend/vendor/datatables/jquery.dataTables.js')}}"></script>
 <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.js')}}"></script>
 <script src="https://cdn.datatables.net/plug-ins/1.10.24/dataRender/ellipsis.js"></script>
 <script src="{{ asset('frontend/js/sweetalert.js') }}"></script>
 {{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script> --}}
 <script src="{{ asset('frontend/js/notyf.min.js') }}"></script>
 <script src="https://unpkg.com/intro.js/minified/intro.min.js"></script>
 <!-- Custom scripts for all pages-->
 <script src="{{asset('backend/js/sb-admin.min.js')}}"></script>
 {{-- Full Calendar JS  --}}
 <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
 {{-- Chart JS  --}}
 <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
 <!-- Demo scripts for this page-->
 <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
 <script src="{{asset('backend/js/admin.js')}}"></script>
 <script src="{{asset('backend/ckeditor/ckeditor.js')}}"></script>
 <script type="text/javascript">
    CKEDITOR.replace('ckeditor');
    CKEDITOR.replace('ckeditor1');

</script>
 @yield('scripts')
 @include('scripts.notyf')

</body>
</html>
