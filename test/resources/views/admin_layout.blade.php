<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">
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

@yield('admin_content')

 <!-- Bootstrap core JavaScript-->
 <script src="{{asset('backend/vendor/jquery/jquery.min.js')}}"></script>
 <script src="{{asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
 <!-- Core plugin JavaScript-->
 <script src="{{asset('backend/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
 <!-- Page level plugin JavaScript-->
 <script src="{{asset('backend/vendor/datatables/jquery.dataTables.js')}}"></script>
 <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.js')}}"></script>
 <!-- Custom scripts for all pages-->
 <script src="{{asset('backend/js/sb-admin.min.js')}}"></script>
 <!-- Demo scripts for this page-->
 <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
 <script src="{{asset('backend/js/admin.js')}}"></script>
</body>
</html>
