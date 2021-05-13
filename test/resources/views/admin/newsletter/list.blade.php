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
       <div class="action-bar">

          <input type="submit" class="btn btn-danger btn-sm" value="Xóa" name="delete">
       </div>
       <div class="card mb-3">
          <div class="card-body">
             <div class="table-responsive">
                <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                   <thead>
                      <tr>
                         <th><input type="checkbox" onclick="checkAll(this)"></th>
                         <th>Email</th>
                         <th></th>
                      </tr>
                   </thead>
                   <tbody>
                       @foreach ($emails as $email)
                       <tr>
                        <td><input type="checkbox"></td>
                        <td>{{$email->email}}</td>
                        <td><input type="button" onclick="Delete('25');" value="Xóa" class="btn btn-danger btn-sm"></td>
                     </tr>
                       @endforeach
                   </tbody>
                </table>
             </div>
          </div>

       </div>
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
@endsection
