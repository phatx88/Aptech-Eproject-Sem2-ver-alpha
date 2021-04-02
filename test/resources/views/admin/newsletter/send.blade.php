@extends('admin_layout')
@section('admin_content')
<div id="content-wrapper">
    <div class="container-fluid">
       <!-- Breadcrumbs-->
       <ol class="breadcrumb">
          <li class="breadcrumb-item">
             <a href="#">Quản lý</a>
          </li>
          <li class="breadcrumb-item active">News letter</li>
       </ol>
       <!-- DataTables Example -->
       
       <form action="">
          <div class="card mb-3">
             <div class="card-body">
                <div class="table-responsive">
                   <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                         <tr>
                            <th><input type="checkbox" onclick="checkAll(this)"></th>
                            <th>Email</th>
                         </tr>
                      </thead>
                      <tbody>
                         <tr>
                            <td><input type="checkbox"></td>
                            <td>a@gmail.com</td>
                            
                         </tr>
                         <tr>
                            <td><input type="checkbox"></td>
                            <td>b@gmail.com</td>
                            
                         </tr>
                      </tbody>
                   </table>
                </div>
             </div>

          </div>
          <div class="row form-group">
             <div class="col-md-9 col-lg-6">
                <input class="form-control" type="text" name="subject" placeholder="Chủ đề">
             </div>
          </div>
          <div class="row form-group">
             <div class="col-md-12">
                <textarea class="form-control" name="description" id="description" rows="10" cols="80" placeholder="Nội dung">
                </textarea>
             </div>
          </div>
          <div class="row form-group">
             <div class="col-md-12 text-center">
                <input type="submit" value="Gởi mail" class="btn btn-primary btn-sm">
             </div>
          </div>      
         
          
       </form>
       

    </div>
    <script type="text/javascript" src="{{ asset('backend/vendor/ckeditor/ckeditor.js') }}"></script>
    <script>CKEDITOR.replace('description');</script>
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